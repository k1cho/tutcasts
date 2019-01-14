<template>
    <div>
        <!-- Modal -->
        <div class="modal fade sharp" id="createLesson" tabindex="-1" role="dialog" aria-labelledby="createLesson"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLesson">Create New Lesson</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control sharp" placeholder="Lesson title" v-model="lesson.title">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control sharp" placeholder="Vimeo Video ID" v-model="lesson.video_id">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control sharp" placeholder="Episode number" v-model="lesson.episode_number">
                        </div>
                        <div class="form-group">
                            <textarea cols="30" rows="10" class="form-control sharp" placeholder="Lesson description"
                                v-model="lesson.description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" v-model="premium" @click="lesson.premium = !lesson.premium"> Premium: {{ lesson.premium }}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary sharp" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary sharp" @click="updateLesson()" v-if="editing">Save
                            Lesson</button>
                        <button type="button" class="btn btn-primary sharp" @click="createLesson()" v-else>Create
                            Lesson</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    class Lesson {
        constructor(lesson) {
            this.title = lesson.title || ''
            this.description = lesson.description || ''
            this.video_id = lesson.video_id || ''
            this.episode_number = lesson.episode_number || ''
            this.premium = lesson.premium || false
        }
    }

    export default {
        mounted() {
            this.$parent.$on('create_new_lesson', (seriesId) => {
                this.seriesId = seriesId
                this.editing = false
                this.lesson = new Lesson({})
                $('#createLesson').modal()
            })

            this.$parent.$on('edit_lesson', ({
                lesson,
                seriesId
            }) => {
                this.editing = true
                this.lesson = new Lesson(lesson)
                this.seriesId = lesson.series_id
                this.lessonId = lesson.id

                $('#createLesson').modal()
            })
        },

        data() {
            return {
                lesson: {},
                seriesId: '',
                lessonId: '',
                editing: false,
                lessonId: null,
                premium: false
            }
        },

        methods: {
            createLesson() {
                axios.post(this.seriesId + '/lessons', this.lesson)
                    .then(response => {
                        this.$parent.$emit('lesson_created', response.data)
                        $('#createLesson').modal('hide')
                    }).catch(error => {
                        window.handleErrors(error)
                    })
            },

            updateLesson() {
                axios.put(this.seriesId + '/lessons/' + this.lessonId, this.lesson)
                    .then(response => {
                        this.$parent.$emit('lesson_updated', response.data)
                        $('#createLesson').modal('hide')
                    }).catch(error => {
                        window.handleErrors(error)
                    })
            }
        }
    }

</script>
