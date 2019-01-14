<template>
    <div v-if="notification">
        <div class="alert alert-success alert-noty sharp">
            <p class="text-center">{{ notification.message }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            window.events.$on('notification', (payload) => {
                this.notification = payload
                setTimeout(() => {
                    this.notification = null
                }, 2500)
            })
        },

        data() {
            return {
                notification: null
            }
        }
    }
</script>

<style>
    .alert-noty {
        position: fixed;
        right: 20px;
        bottom: 40px;
        z-index: 1;
    }
</style>
