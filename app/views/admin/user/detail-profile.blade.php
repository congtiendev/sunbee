 @extends('admin.layouts.master')
 @section('content')
     <main class="w-full h-full bg-white  overflow-y-auto p-2 sm:p-5 rounded-2xl hidden__scrollbar">
         <!-- ------------------------wrapper title & fill  -->
         <div class="lg:w-8/12 lg:mx-auto mb-8">
             <header class="flex flex-wrap items-center p-4 md:py-8">
                 <div class="md:w-3/12 md:ml-16">
                     <!-- avatar -->
                     <img class="w-20 h-20 md:w-40 md:h-40  object-cover rounded-full
                             border-2 border-pink-600 p-1"
                         src="{{ empty($user->avatar) ? BASE_URL . 'resources/images/default-avatar.jpg' : BASE_URL . 'public/uploads/avatar/' . $user->avatar }}"
                         alt="profile">
                 </div>

                 <!-- profile meta -->
                 <div class="w-8/12 md:w-7/12 ml-4">
                     <div class="md:flex md:flex-wrap md:items-center mb-4">
                         <h2
                             class="fullname text-xl sm:text-2xl md:text-3xl text-gray-900 inline-block font-light md:mr-2 mb-2 sm:mb-0 whitespace-nowrap">
                             {{ $user->first_name }} {{ $user->last_name }}
                         </h2>

                         <!-- icon tick -->
                         <span
                             class="inline-block fas fa-certificate fa-lg text-blue-500 
                                       relative mr-6  text-xl transform -translate-y-2"
                             aria-hidden="true">
                             <i
                                 class="fas fa-check text-white text-xs absolute inset-x-0
                                       ml-1 mt-px"></i>
                         </span>

                         <!-- follow button -->
                         <a href="#"
                             class="bg-blue-500 px-2 py-1 
                                text-white font-semibold text-sm rounded block text-center 
                                sm:inline-block">Theo
                             dõi</a>
                     </div>

                     <!-- post, following, followers list for medium screens -->
                     <ul class="hidden md:flex space-x-8 mb-4 text-gray-900 whitespace-nowrap">
                         <li>
                             <span class="font-semibold">6</span>
                             Bài viết
                         </li>

                         <li>
                             <span class="font-semibold">50.5k</span>
                             Người theo dõi
                         </li>
                         <li>
                             <span class="font-semibold">10</span>
                             Đang theo dõi
                         </li>
                     </ul>

                     <!-- user meta form medium screens -->
                     <div class="hidden md:block text-gray-900">
                         <h1 class="username font-semibold">{{ $user->username }}</h1>
                         <span class="job">Internet company</span>
                         <p class="bio">{{ $user->bio }}</p>
                         <span class="website"><strong>www.bytewebster.com</strong></span>
                     </div>

                 </div>

                 <!-- user meta form mobile screens -->
                 <div class="md:hidden text-sm my-2 text-gray-900">
                     <h1 class="username font-semibold">{{ $user->username }}</h1>
                     <span class="job">Internet company</span>
                     <p class="bio">{{ $user->bio }}</p>
                     <span class="website"><strong>www.bytewebster.com</strong></span>
                 </div>

             </header>

             <!-- posts -->
             <div class="px-px md:px-3">
                 <!-- user following for mobile only -->
                 <ul
                     class="flex md:hidden justify-around space-x-8 border-t 
                        text-center p-2 text-gray-600 leading-snug text-sm">
                     <li>
                         <span class="font-semibold text-gray-800 block">6</span>
                         Bài viết
                     </li>

                     <li>
                         <span class="font-semibold text-gray-800 block">50.5k</span>
                         Người theo dõi
                     </li>
                     <li>
                         <span class="font-semibold text-gray-800 block">10</span>
                         Đang theo dõi
                     </li>
                 </ul>
                 <br>
                 <br>
                 <!-- insta freatures -->
                 <ul
                     class="flex items-center justify-around md:justify-center space-x-12  
                            uppercase tracking-widest font-semibold text-xs text-gray-600
                            border-t">
                     <!-- posts tab is active -->
                     <li class="md:border-t md:border-gray-700 md:-mt-px md:text-gray-700">
                         <a class="p-3 flex gap-2 items-center" href="#">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                             </svg>
                             <span class="hidden md:inline">Bài đăng</span>
                         </a>
                     </li>
                     <li>
                         <a class="p-3 flex gap-2 items-center" href="#">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                             </svg>
                             <span class="hidden md:inline">Đã lưu</span>
                         </a>
                     </li>
                     <li>
                         <a class="p-3 flex gap-2 items-center" href="#">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                     d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                             </svg>
                             <span class="hidden md:inline">Được gắn thẻ</span>
                         </a>
                     </li>
                 </ul>
                 <!-- flexbox grid -->
                 <div class="flex flex-wrap -mx-px md:-mx-3">

                     <!-- column -->
                     <div class="w-1/3 p-px md:px-3">
                         <!-- post 1-->
                         <a href="#">
                             <article class="post bg-gray-100 text-white relative pb-full md:mb-6">
                                 <!-- post images-->
                                 <img class="w-full h-full absolute left-0 top-0 object-cover"
                                     src="../../../../resources/images/avatars/avatar-1.jpg" alt="image">

                                 <i class="fas fa-square absolute right-0 top-0 m-1"></i>
                                 <!-- overlay-->
                                 <div
                                     class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute 
                                        left-0 top-0 hidden">
                                     <div
                                         class="flex justify-center items-center 
                                            space-x-4 h-full">
                                         <span class="p-2 flex items-center gap-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                             </svg>

                                             412K
                                         </span>

                                         <span class="p-2 flex items-center gap-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                             </svg>
                                             2,909
                                         </span>
                                     </div>
                                 </div>

                             </article>
                         </a>
                     </div>

                     <div class="w-1/3 p-px md:px-3">
                         <a href="#">
                             <!-- post 2 -->
                             <article class="post bg-gray-100 text-white relative pb-full md:mb-6">
                                 <img class="w-full h-full absolute left-0 top-0 object-cover"
                                     src="../../../../resources/images/avatars/avatar-1.jpg" alt="image">

                                 <!-- overlay-->
                                 <div
                                     class="overlay bg-gray-800 bg-opacity-25 w-full h-full absolute 
                                        left-0 top-0 hidden">
                                     <div
                                         class="flex justify-center items-center 
                                            space-x-4 h-full">
                                         <span class="p-2 flex items-center gap-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                             </svg>

                                             412K
                                         </span>

                                         <span class="p-2 flex items-center gap-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                 <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                             </svg>
                                             1,993
                                         </span>
                                     </div>
                                 </div>

                             </article>
                         </a>
                     </div>

                 </div>
             </div>
         </div>

     </main>
 @endsection