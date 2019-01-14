@extends('layouts.app')

@section('content')
<vue-login inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group row" v-if="errors.length > 0">
                                <div class="col-md-8 offset-2">
                                    <ul class="list-group alert alert-danger">
                                        <li class="list-group-item" v-for="error in errors">
                                            <span v-text="error"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                        required autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input v-model="password" id="password" type="password" class="form-control" name="password"
                                        required>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input v-model="remember" class="form-check-input" type="checkbox" name="remember"
                                            id="remember">

                                        <label class="form-check-label" for="remember">
                                            Remember Me?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" @click.prevent="attemptLogin" class="btn btn-primary sharp"
                                        :disabled="!isValidLoginForm">
                                        Log In
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</vue-login>
@endsection
