@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">Connect. Chat. Collaborate.</h1>
            <p class="mt-4 text-lg sm:text-xl text-gray-600">Experience seamless real-time messaging with a modern interface.
                Stay connected with friends, colleagues, or customers instantly.</p>
            <a href="#get-started"
                class="mt-8 inline-block px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">Start
                Chatting Now</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6 grid gap-10 sm:grid-cols-2 lg:grid-cols-4 text-center">

            <!-- Feature 1 -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <img src="https://img.icons8.com/color/96/000000/chat--v1.png" class="mx-auto mb-4"
                    alt="Real-time Chat Icon" />
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Real-Time Messaging</h3>
                <p class="text-gray-600">Messages appear instantly using WebSockets so you never miss a conversation.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <img src="https://img.icons8.com/color/96/000000/user-group-man-man.png" class="mx-auto mb-4"
                    alt="Avatars Icon" />
                <h3 class="text-xl font-semibold text-gray-900 mb-2">User Avatars & Status</h3>
                <p class="text-gray-600">Know who sent messages and when they’ve been read for seamless communication.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-4 text-blue-600" fill="none"
                    viewBox="0 0 20 20" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8h10M7 12h10M7 16h10M5 4h14v16H5V4z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Responsive Design</h3>
                <p class="text-gray-600">Works perfectly on desktop, tablet, and mobile devices without compromising
                    experience.</p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <img src="https://img.icons8.com/color/96/000000/design.png" class="mx-auto mb-4" alt="UI Icon" />
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Clean & Minimal UI</h3>
                <p class="text-gray-600">Modern interface for effortless interaction and easy navigation.</p>
            </div>

        </div>
    </section>

    <!-- CTA Section -->
    <section id="get-started" class="bg-blue-600 py-20 text-center text-white">
        <h2 class="text-3xl sm:text-4xl font-bold">Ready to start chatting?</h2>
        <p class="mt-4 text-lg sm:text-xl">Sign up and connect instantly with your friends and colleagues.</p>
        <a href="/register"
            class="mt-8 inline-block px-8 py-4 bg-white text-blue-600 rounded-lg hover:bg-gray-100 font-medium">Get
            Started</a>
    </section>
@endsection
