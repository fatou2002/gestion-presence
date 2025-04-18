@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #1f1c2c, #928DAB);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;
            min-height: 100vh;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.07);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
        }

        .form-control::placeholder,
        .form-label {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-custom {
            background-color: #4e9af1;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #357edb;
        }

        .text-light-link a {
            color: #cde2ff;
            text-decoration: underline;
        }
        /* Animation pulse */
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 rgba(255, 255, 255, 0.5);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        .pulse {
            animation: pulse 0.4s ease;
        }

    </style>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="glass-card">

                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 100px;">
                </div>

                <h2 class="text-center mb-4">🔐 Connexion</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="Votre e-mail">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Votre mot de passe">
                    </div>

                    <button type="submit" class="btn btn-custom w-100 mt-3" id="loginBtn">
                        Se connecter
                    </button>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <p class="mt-4 text-center text-light-link">
                    Vous n’avez pas de compte ? <a href="{{ route('register.form') }}">Créer un compte</a>
                </p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginBtn = document.getElementById('loginBtn');

            loginBtn.addEventListener('click', function () {
                loginBtn.classList.add('pulse');

                setTimeout(() => {
                    loginBtn.classList.remove('pulse');
                }, 400);
            });
        });
    </script>

@endsection
