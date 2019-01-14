<template>
    <div style="width: 100% !important; height: auto;">
        <div v-if="lesson" :data-vimeo-id="lesson.video_id" data-vimeo-width="1034" id="handstick"></div>
    </div>
</template>

<script>
    import axios from 'axios'
    import Player from '@vimeo/player'
    import swal from 'sweetalert'
    export default {
        props: ['default_lesson', 'next_lesson_url'],

        data() {
            return {
                lesson: JSON.parse(this.default_lesson),
                nextLesson: this.next_lesson_url
            }
        },

        methods: {
            displayVideoEndedAlert() {
                if (this.nextLesson) {
                    swal('Yaay! You completed this Lesson.')
                        .then(() => {
                            window.location = this.nextLesson
                        })
                } else {
                    swal('Yaay! You completed this Series.')
                }
            },

            completeLesson() {
                axios.post('/series/complete-lesson/' + this.lesson.id, {

                }).then(response => {
                    this.displayVideoEndedAlert()
                }).catch(error => {
                    console.log(error)
                })
            }
        },

        mounted() {
            const player = new Player('handstick')

            player.on('ended', () => {
                this.completeLesson()
            })
        }
    }

</script>
