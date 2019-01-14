<template>
    <div class="text-center">
        <button class="btn btn-outline-light sharp" @click="subscribe('monthly')"><strong>SUBSCRIBE FOR $9.99/MONTH</strong></button>
        <button class="btn btn-outline-light sharp" @click="subscribe('yearly')"><strong>SUBSCRIBE FOR $99.99/YEAR</strong></button>
    </div>
</template>

<script>
    import axios from 'axios'
    import swal from 'sweetalert'

    export default {
        props: ['email'],

        data() {
            return {
                plan: '',
                amount: 0,
                handler: null,
                userEmail: this.email
            }
        },

        mounted() {
            this.handler = StripeCheckout.configure({
                key: 'pk_test_ohix6iEnk3yInsBVISQ7F4Nu',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                token(token) {
                    swal({
                        text: 'Please wait while we subscribe you to a plan...',
                        buttons: false
                    })

                    axios.post('/subscribe', {
                        stripeToken: token.id,
                        plan: window.stripePlan
                    }).then(response => {
                        swal({
                            text: 'Successfully subscribed.',
                            icon: 'success'
                        }).then(() => {
                            windows.location = ''
                        })
                    }).catch(error => {
                        console.log(error.resonse)
                    })
                }
            });
        },

        methods: {
            subscribe(plan) {
                if (plan == 'monthly') {
                    window.stripePlan = 'plan_E3D09nsxZZSsZS',
                        this.amount = 999
                } else {
                    window.stripePlan = 'plan_E3Cz1UsJCprWWt',
                        this.amount = 9999
                }

                this.handler.open({
                    name: 'TutCasts',
                    description: 'TutCasts Subscription',
                    amount: this.amount,
                    email: this.userEmail
                })
            }
        }
    }

</script>
