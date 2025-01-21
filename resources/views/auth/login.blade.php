<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Informasi Terpadu (PINTU)</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <div class="relative">
            <img
                src="{{ asset('images/Login_Image.png') }}"
                alt="Image"
                class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover"
            />
            </div>
            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-3xl font-bold text-center p-10 text-our_red">Login PINTU</span>
                <span>Silahkan Masukan Username dan Password sesuai dengan SSO yang sudah terdaftar</span>
                <form action="{{ route('login') }}" method="POST">
                @csrf
                    <div class="py-4">
                        <span class="mb-2 text-md">Username</span>
                        <input
                        type="text"
                        class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                        name="username"
                        id="username"
                        required
                        />
                    </div>
                    <div class="py-4">
                        <span class="mb-2 text-md">Password</span>
                        <input
                        type="password"
                        class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-white-500"
                        name="password"
                        id="password"
                        required
                        />
                    </div>
                    
                    @if(session('error'))
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                
                    <div class="flex justify-between w-full py-4">
                        <span class="font-bold text-black">
                            <a href="/register" class="hover:underline">Forgot Password</a>
                        </span>
                        <span class="font-bold text-black">
                            <a href="/register" class="hover:underline">Create Account</a>
                        </span>
                    </div>
                    <button type="submit" class="w-full font-bold text-lg bg-our_red text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300 hover:border-b-10"> Login </button>
                </form>
            </div>
            
        </div>
        
        
        
    </div>
    
</body>
</html>