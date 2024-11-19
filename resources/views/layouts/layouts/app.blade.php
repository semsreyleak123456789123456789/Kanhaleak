<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="{{ url('IMG/logo.jpg') }}">
    <title>@yield('title') - YorkMars</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"> --}}
    {{-- summernote --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">


    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/froala-editor@4.0.10/js/froala_editor.pkgd.min.js"></script>
    <script src="../scripts/js/open-modals-on-init.js"></script>
    {{-- Summernote --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .fancy-table {
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 0.9em;
            text-align: center;
        }

        .fancy-table thead {
            background-color: #746123;
        }

        .fancy-table thead th {
            color: #ffffff;
            text-align: center;
            padding: 10px;
        }

        .fancy-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .fancy-table tbody tr:nth-of-type(odd) {
            background-color: #ffffff;
        }

        .fancy-table tbody tr:hover {
            background-color: #e0e0e0
        }

        .fancy-table tbody td {
            padding: 10px;
        }
    </style>
    <!-- Add SweetAlert2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div
                    class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 {{ isset($link) ? 'items-center flex justify-between' : '' }}">
                    @if (isset($link))
                        {{ $link }}
                    @endif
                    <div class="px-2">
                        {{ $header }}
                    </div>
                    <div class="md:px-52">
                    </div>
                    @if (isset($link1))
                        {{ $link1 }}
                    @endif
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main x-data="chatbotData()" x-init="init()" x-cloak>
            {{ $slot }}
            <div class="z-30 fixed bottom-0 right-3 max-w-3xl justify-center">
                @php
                    $alertTypes = ['danger', 'success', 'warning'];
                @endphp

                @foreach ($alertTypes as $type)
                    @if (Session()->has($type))
                        <x-alert :type="$type" :message="Session()->get($type)" />
                    @endif
                @endforeach
            </div>

            <div class="z-20 fixed bottom-5 right-5">
                <button @click="toggleChat"
                    class="flex justify-center items-center size-[52px] bg-yellow-500 hover:opacity-90 transition-opacity rounded-full shadow-lg">
                    {{-- <svg x-show="!isChatOpen" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                        <path d="M7.066 6.76A1.665 1.665 0 0 0 4 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z"/>
                    </svg> --}}
                    <img src="{{ asset('IMG/bot-logo2.png') }}" x-show="!isChatOpen" alt="Chat Bot" class="size-8">
                    <svg x-show="isChatOpen" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>

            <div x-show="isChatOpen" x-ref="chatArea"
                class="z-30 transition-all duration-500 ease-out fixed bottom-20 right-5 bg-gray-200 border border-yellow-300 shadow-lg rounded-lg overflow-auto max-w-[90vw] w-[360px] h-96 flex flex-col"
                x-transition:enter="transition ease-out duration-200  origin-bottom-right"
                x-transition:enter-start="opacity-0 scale-50"
                x-transition:enter-end="opacity-100 scale-100 origin-bottom-right"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-50 origin-bottom-right">

                <div class="bg-yellow-500 text-gray-800 p-3 flex justify-between items-center rounded-t-lg">
                    <div class="flex items-center">
                        <img src="{{ asset('IMG/bot-logo.png') }}" alt="Chat Bot" class="size-7">
                        <h3 class="font-bold ml-1.5">YAi</h3>
                    </div>
                    <button @click="toggleFullscreen" class="text-blue-950">
                        <svg x-show="!isFullscreen" class="size-4" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707m4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707m0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707m-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707" />
                        </svg>
                        <svg x-show="isFullscreen" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M5.5 0a.5.5 0 0 1 .5.5v4A1.5 1.5 0 0 1 4.5 6h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5m5 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 10 4.5v-4a.5.5 0 0 1 .5-.5M0 10.5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 6 11.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5m10 1a1.5 1.5 0 0 1 1.5-1.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0z" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-4 bg-gray-100" id="chat-area"
                    :class="isFullscreen ? 'text-md' : 'text-sm'">
                    <template x-for="msg in messages" :key="msg.id">
                        <div :class="msg.isUser ? 'text-right' : 'text-left'">
                            <div :class="[msg.isUser ? 'bg-neutral-300 mb-3 my-3' : 'bg-amber-300', isFullscreen && 'sm:max-w-6xl']"
                                class="inline-block p-2 rounded-lg shadow-md max-w-64 overflow-x-auto">
                                <span x-html="msg.text" :id="'message-' + msg.id" class="break-words"></span>
                            </div>

                            <!-- Buttons div (conditionally rendered) -->
                            <div x-show="msg.buttons && msg.buttons.length > 0" :class="isFullscreen && 'sm:max-w-xl'"
                                class="flex justify-start gap-1 mt-1 max-w-64">
                                <template x-for="button in msg.buttons" :key="button.title">
                                    <button @click="handleButtonClick(button)"
                                        class="bg-blue-500 max-w-fit text-white p-2 rounded-lg hover:bg-blue-600"
                                        :class="isFullscreen ? 'text-sm' : 'text-xs'">
                                        <span x-text="button.title"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>

                    <div x-show="isTyping" class="text-gray-600 text-sm flex items-center space-x-1">
                        <div class="size-1 rounded-full bg-gray-600 animate-pulse"></div>
                        <div class="size-1 rounded-full bg-gray-600 animate-pulse delay-150"></div>
                        <div class="size-1 rounded-full bg-gray-600 animate-pulse delay-300"></div>
                    </div>
                </div>

                <div class="px-4 pb-3 pt-2 bg-white rounded-b-lg flex">
                    <input x-model="userInput" @keydown.enter="sendMessage" type="text"
                        class="w-full flex-grow py-1.5 px-0 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-yellow-500"
                        placeholder="Write a message...">
                    <button @click="sendMessage" class="bg-yellow-500 text-white px-4 ml-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-send-fill" viewBox="0 0 16 16">
                            <path
                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                        </svg>
                    </button>
                </div>

            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    @yield('js')
    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import {
            getMessaging,
            onMessage,
            getToken
        } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js";
        const firebaseConfig = {
            apiKey: "AIzaSyCTy_jRlqvSvy1-kCh2BtXanre-twUjyw8",
            authDomain: "yorkmars.firebaseapp.com",
            projectId: "yorkmars",
            storageBucket: "yorkmars.appspot.com",
            messagingSenderId: "623393875848",
            appId: "1:623393875848:web:dd72ca40f602658967bc3d",
            measurementId: "G-1X4DS34XF3"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);

        // Handle foreground messages
        onMessage(messaging, (payload) => {
            // Update the notification count
            let countElement = document.getElementById('countNoti');
            let oldNumber = parseInt(countElement.textContent) || 0;
            countElement.textContent = oldNumber + 1;

            // Create the notification HTML
            const notification = `
                    <a href="${payload.data.url || "#"}" class="flex items-center justify-between py-1 border-b hover:bg-gray-100 clickread" id="${payload.data.noti_id}">
                        <div class="text-gray-600 mx-2">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold text-sm">${payload.notification.title}</p>
                                <p class="text-xs text-gray-500">Now</p>
                            </div>
                            <p class="text-sm">${payload.notification.body}</p>
                        </div>
                        <div class="relative">
                            <p class="bg-blue-500 h-2 w-2 rounded-full absolute top-0 right-0"></p>
                        </div>
                    </a>
                `;

            // Insert the new notification at the beginning of the list
            document.getElementById('notifications').insertAdjacentHTML('afterbegin', notification);
            clickReadNotify();
            // Optionally, you could make the dropdown visible if it's not already
            let dropdown = document.getElementById('notificationsDropdown');
            if (dropdown) {
                dropdown.style.display = 'block'; // or use class-based visibility
            }
        });

        function clickReadNotify() {
            if ($(".clickread")) {
                $(".clickread").on("click", function() {
                    let id = $(this).attr('id');
                    let data = {
                        id: id,
                    }
                    $.ajax({
                        type: "GET",
                        url: "/dashboard/notifications",
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: (xhr) => {},
                        success: (data) => {
                            if (data['status'] == true) {} else {}
                        }

                    });
                });
            }
        }

        function seeMoreNotification() {
            let skip = 20;
            $("#seeMore").on("click", function() {
                fetch(`/dashboard/notifications/more?skip=${skip}`)
                    .then(response => response.json())
                    .then(data => {
                        const notificationsContainer = document.getElementById('notifications');
                        data.forEach(noti => {
                            console.log(noti)

                            const timeAgo = moment(noti.created_at).fromNow();
                            const notiHtml = `
                                    <a href="${noti.url}" class="flex items-center justify-between py-1 border-b hover:bg-gray-100 clickread" id="${noti._id}">
                                        <div class="text-gray-600 mx-2">
                                            <div class="flex justify-between items-center">
                                                <p class="${noti.read === 0 ? 'font-semibold' : ''} text-sm">${noti.title} </p>
                                                <p class="text-xs text-gray-500">${timeAgo}</p>
                                            </div>
                                            <p class="text-sm">${noti.body}</p>
                                        </div>
                                        ${noti.read === 0 ? '<div class="relative"><p class="bg-blue-500 h-2 w-2 rounded-full absolute top-0 right-0"></p></div>' : ''}
                                    </a>
                                `;
                            notificationsContainer.insertAdjacentHTML('beforeend', notiHtml);
                            clickReadNotify();
                        });
                        skip += 10;
                        if (!data.length) {
                            document.getElementById('seeMore').style.display = 'none';
                        }

                    })
                    .catch(error => console.error('Error:', error));
            });
        }

        seeMoreNotification();
        clickReadNotify();
    </script>

    <script>
        function generateUniqueId() {
            return Date.now() + Math.random().toString(36).substr(2, 9);
        }

        function chatbotData() {
            return {
                isChatOpen: false,
                isFullscreen: false,
                isTyping: false,
                userInput: '',
                messages: [{
                    id: generateUniqueId(),
                    text: "Hey, I am an Assistant at Yorkmars (Cambodia) Garment MFG Co., LTD",
                    isUser: false
                }],

                toggleChat() {
                    this.isChatOpen = !this.isChatOpen;
                    this.scrollToBottom();
                },

                toggleFullscreen() {
                    this.isFullscreen = !this.isFullscreen;
                    const chatArea = this.$refs.chatArea;
                    chatArea.classList.toggle('h-[calc(100vh-100px)]');
                    chatArea.classList.toggle('w-[calc(100vw-40px)]');
                    chatArea.classList.toggle('max-w-[90vw]');
                    chatArea.classList.toggle('max-h-[90vh]');
                    this.scrollToBottom();
                },

                async sendMessage() {
                    if (this.userInput.trim() !== '') {
                        const input = this.userInput;
                        this.userInput = '';
                        this.messages.push({
                            id: generateUniqueId(),
                            text: input,
                            isUser: true
                        });
                        this.scrollToBottom();
                        this.saveMessages();

                        this.isTyping = true;
                        try {
                            const response = await this.getRasaResponse(input);
                            Object.entries(response).forEach(([key, value]) => {
                                value.forEach(response => {
                                    this.messages.push({
                                        id: generateUniqueId(),
                                        text: response.text || response.text,
                                        buttons: response.buttons,
                                        isUser: false
                                    });
                                });
                            });

                        } catch (error) {
                            console.error('Error sending message:', error);
                        } finally {
                            this.isTyping = false;
                            this.scrollToBottom();
                            this.saveMessages();
                        }
                    }
                },

                async getRasaResponse(message) {
                    const response = await fetch('/rasa-webhook', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return await response.json();
                },

                async handleButtonClick(button) {
                    // Find the message that contains the clicked button
                    const msg = this.messages.find(msg => msg.buttons && msg.buttons.includes(button));

                    // Remove the buttons from the message
                    if (msg) {
                        msg.buttons = [];
                    }

                    this.messages.push({
                        id: generateUniqueId(),
                        text: ` ${button.title}`,
                        isUser: true,
                        buttons: []
                    });
                    this.scrollToBottom();
                    this.saveMessages();

                    this.isTyping = true;
                    try {
                        const response = await this.getRasaResponse(button.payload);
                        Object.entries(response).forEach(([key, value]) => {
                            value.forEach(response => {
                                this.messages.push({
                                    id: generateUniqueId(),
                                    text: response.text,
                                    buttons: response.buttons,
                                    isUser: false
                                });
                            });
                        });

                    } catch (error) {
                        console.error('Error handling button click:', error);
                    } finally {
                        this.isTyping = false;
                        this.scrollToBottom();
                        this.saveMessages();
                    }
                },

                saveMessages() {
                    const messages = JSON.stringify(this.messages);
                    localStorage.setItem('chatMessages', messages);
                },

                // Call this method on initialization
                loadMessages() {
                    const savedMessages = localStorage.getItem('chatMessages');
                    if (savedMessages) {
                        this.messages = JSON.parse(savedMessages);
                    }
                },

                // Automatically clear messages at midnight
                clearMessagesAtMidnight() {
                    const now = new Date();
                    const midnight = new Date();
                    midnight.setHours(23, 0, 0, 0);
                    const timeUntilMidnight = midnight - now;

                    setTimeout(() => {
                        localStorage.removeItem('chatMessages');
                        this.messages = [];
                        this.saveMessages();
                    }, timeUntilMidnight);
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const chatArea = document.getElementById('chat-area');
                        chatArea.scrollTop = chatArea.scrollHeight;
                    });
                },

                init() {
                    this.loadMessages();
                    this.scrollToBottom();
                    this.clearMessagesAtMidnight(); // Start the timer to clear messages at midnight
                },
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: 'Select Source',
                allowClear: true
            });

            $(".validate_main_item_parent").each(function() {
                let allDivs = $(this).find(".validate_main_item");

                let allEmpty = true;
                allDivs.each(function() {
                    if ($(this).text().trim() !== "") {
                        allEmpty = false;
                        return false;
                    }
                });

                if (allEmpty) {
                    $(this).remove();
                }
            });
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

</body>

</html>
