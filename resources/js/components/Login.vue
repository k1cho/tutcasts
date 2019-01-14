<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                email: '',
                password: '',
                remember: true,
                loading: false,
                errors: []
            }
        },

        computed: {
            isValidLoginForm() {
                return this.emailIsValid(this.email) && this.password && !this.loading
            }
        },

        methods: {
            emailIsValid(email) {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    return (true)
                } else {
                    return (false)
                }
            },

            attemptLogin() {
                this.errors = []
                this.loading = true
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                }).then((response) => {
                    location.reload()
                }).catch((error) => {
                    this.loading = false
                    if (error.response.status == 422) {
                        this.errors.push("We couldn't verify your account details.")
                    } else {
                        this.errors.push("Something went wrong, please try again.")
                    }
                })
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }

</script>
