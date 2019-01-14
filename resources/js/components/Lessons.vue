<template>
    <div class="container text-center" style="color:black; font-weight: bold;">
        <h1 class="text-center">
            <button class="btn btn-primary sharp" @click="createNewLesson()">
                Create New Lesson
            </button>
        </h1>
        <ul class="list-group">
            <li class="list-group-item" v-for="(lesson, index) in lessons" :key="index">
                    <span v-if="lesson.premium" style="float:left;">Premium</span>
                    <span>{{ lesson.title }}</span>
                    
                    <button class="btn btn-danger btn-sm sharp right" @click="deleteLesson(lesson.id, index)">Delete</button>
                    <button class="btn btn-primary btn-sm sharp right" @click="editLesson(lesson)">Edit</button>
            </li>
        </ul>
        <create-lesson></create-lesson>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        props: ['default_lessons', 'series_id'],

        mounted() {
            this.$on('lesson_created', (lesson) => {
                this.lessons.push(lesson)

                window.noty({
                    message: 'Lesson created successfully',
                    type: 'success'
                })
            })

            this.$on('lesson_updated', (lesson) => {
                this.lessons.splice(this.lessons.findIndex(l => {
                    return lesson.id == l.id
                }), 1, lesson)

                window.noty({
                    message: 'Lesson updated successfully',
                    type: 'success'
                })
            })
        },

        components: {
            'create-lesson': require('./children/CreateLesson.vue')
        },

        data() {
            return {
                lessons: JSON.parse(this.default_lessons)
            }
        },


        methods: {
            createNewLesson() {
                this.$emit('create_new_lesson', this.series_id)
            },

            deleteLesson(lessonId, index) {
                if(confirm('Are you sure you want to delete this Lesson?')) {
                    axios.delete(this.series_id + '/lessons/' + lessonId)
                            .then(response => {
                                this.lessons.splice(index, 1)

                                window.noty({
                                    message: 'Lesson deleted successfully',
                                    type: 'success'
                                })
                            })
                            .catch(error => {
                                window.handleErrors(error)
                            })
                }
            },

            editLesson(lesson) {
                let series_id = this.series_id
                this.$emit('edit_lesson', { lesson, series_id })
            }
        }
    }
</script>

<style>
    .right {
        float: right;
        margin: 5px;
    }

    .middle {
        position: relative;
    }
</style>