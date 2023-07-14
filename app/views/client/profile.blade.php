@extends('client.layouts.master')
@section('content')
<!-- Main Contents -->
<div class="main_content">
    <div class="mcontainer">

        <!-- Profile cover -->
        <div class="profile user-profile">

            <div class="profiles_banner">
                <img src="{{ COVER_PATH }}{{ $user->cover_photo }}" alt="">
                <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex">
                    <a href="#" class="flex items-center justify-center h-8 px-3 rounded-md bg-gray-700 bg-opacity-70 text-white space-x-1.5">
                        <ion-icon name="create-outline" class="text-xl"></ion-icon>
                        <span> Edit </span>
                    </a>
                </div>
            </div>
            <div class="profiles_content">

                <div class="profile_avatar">
                    <div class="profile_avatar_holder">
                        <img src="{{ AVATAR_PATH }}{{ $user->avatar }}" alt="">
                    </div>
                    <div class="user_status status_online"></div>
                    <div class="icon_change_photo" hidden>
                        <ion-icon name="camera" class="text-xl"></ion-icon>
                    </div>
                </div>

                <div class="profile_info">
                    <h1> {{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-center"> {{ $user->bio }}</p>
                </div>

            </div>

            <div class="flex justify-between lg:border-t border-gray-100 flex-col-reverse lg:flex-row pt-2">
                <nav class="responsive-nav pl-3">
                    <ul uk-switcher="connect: #timeline-tab; animation: uk-animation-fade">
                        <li><a href="#">Bài viết</a></li>
                        <li><a href="#">Bạn bè <span>{{ count($friends) }}</span> </a></li>
                        <li><a href="#">Ảnh </a></li>
                        <li><a href="#">Trang</a></li>
                        <li><a href="#">Nhóm</a></li>
                        <li><a href="#">Video</a></li>
                    </ul>
                </nav>

                <!-- button actions -->
                <div class="flex items-center space-x-1.5 flex-shrink-0 pr-4 mb-2 justify-center order-1 relative">

                    <!-- add story -->
                    <a href="#" class="flex items-center justify-center h-10 px-5 rounded-md bg-blue-600 text-white space-x-1.5 hover:text-white" uk-toggle="target: #create-post-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                        </svg>
                        <span> Thêm vào tin</span>
                    </a>

                    <!-- search icon -->
                    <a href="#" class="flex items-center justify-center h-10 w-10 rounded-md bg-gray-100" uk-toggle="target: #profile-search;animation: uk-animation-slide-top-small">
                        <ion-icon name="search" class="text-xl"></ion-icon>
                    </a>
                    <!-- search dropdown -->
                    <div class="absolute right-3 bg-white z-10 w-full flex items-center border rounded-md" id="profile-search" hidden>
                        <input type="text" placeholder="Search.." class="flex-1">
                        <ion-icon name="close-outline" class="text-2xl hover:bg-gray-100 p-1 rounded-full mr-2 cursor-pointer" uk-toggle="target: #profile-search;animation: uk-animation-slide-top-small"></ion-icon>
                    </div>

                    <!-- more icon -->
                    <a href="#" class="flex items-center justify-center h-10 w-10 rounded-md bg-gray-100">
                        Xem thêm
                    </a>
                    <!-- more drowpdown -->
                    <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small; offset:5">
                        <ul class="space-y-1">
                            <li>
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                    <ion-icon name="arrow-redo-outline" class="pr-2 text-xl"></ion-icon> Share Profile
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                    <ion-icon name="create-outline" class="pr-2 text-xl"></ion-icon> Account setting
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                    <ion-icon name="notifications-off-outline" class="pr-2 text-lg"></ion-icon> Disable notifications
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                    <ion-icon name="star-outline" class="pr-2 text-xl"></ion-icon> Add favorites
                                </a>
                            </li>
                            <li>
                                <hr class="-mx-2 my-2 dark:border-gray-800">
                            </li>
                            <li>
                                <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-50 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                                    <ion-icon name="stop-circle-outline" class="pr-2 text-xl"></ion-icon> Unfriend
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

        <div class="uk-switcher lg:mt-8 mt-4" id="timeline-tab">

            <!-- Timeline -->
            <div class="md:flex md:space-x-6 lg:mx-16">
                <div class="space-y-5 flex-shrink-0 md:w-7/12">
                    <!-- create post  -->
                    <div class="p-4 card lg:mx-0" uk-toggle="target: #create-post-modal">
                        <div class="flex space-x-3">
                            <img src="{{ empty($user->avatar) ? AVATAR_PATH . 'default-avatar.jpg' : AVATAR_PATH . $user->avatar }}" class="object-cover w-10 h-10 rounded-full">
                            <input placeholder="{{ $user->last_name }} ơi, bạn đang nghĩ gì thế  ?" class="flex-1 h-10 px-6 bg-gray-100 rounded-full hover:bg-gray-200">
                        </div>
                        <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 text-sm font-semibold">
                            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer  ">
                                <img src="{{ IMG_PATH }}icon/post-icon.png" class="w-10 h-auto">
                                <span class="ml-1 text-xs sm:ml-2 sm:text-sm whitespace-nowrap">Ảnh/Video</span>
                            </div>
                            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer  ">
                                <img src="{{ IMG_PATH }}icon/tag-icon.png" class="h-auto w-11">
                                <span class="ml-1 text-xs sm:ml-2 sm:text-sm whitespace-nowrap">Gắn thẻ</span>
                            </div>
                            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer  ">
                                <img src="{{ IMG_PATH }}icon/feelings.png" class="h-auto w-9">
                                <span class="ml-1 text-xs sm:ml-2 sm:text-sm whitespace-nowrap">Cảm xúc</span>
                            </div>
                        </div>
                    </div>
                    <!-- -------------------------Create post modal --------------------------------->

                    <div id="create-post-modal" class="create-post is-story" uk-modal>
                        <form data-user-id="{{ $user->id }}" method="post" id="create-post" enctype="multipart/form-data" class="p-0 rounded-lg shadow-2xl uk-modal-dialog uk-modal-body uk-margin-auto-vertical lg:w-5/12 uk-animation-slide-bottom-small">

                            <div class="py-3 text-center border-b">
                                <h3 class="text-lg font-semibold"> Tạo bài viết</h3>
                                <button class="uk-modal-close-default bg-gray-100 rounded-full p-2.5 right-2" type="button" uk-close uk-tooltip="title: Đóng ; pos: bottom ;offset:7"></button>
                            </div>
                            <div class="flex items-start flex-1 p-5 space-x-4 user">
                                <img src="{{ empty($user->avatar) ? AVATAR_PATH . 'default-avatar.jpg' : AVATAR_PATH . $user->avatar }}" class="object-cover bg-gray-200 border border-white rounded-full w-11 h-11">
                                <div class="flex-1 pt-2">
                                    <textarea id="post_content" class="text-lg font-medium text-black shadow-none resize-none md:text-sm dark:text-white uk-textare focus:shadow-none" rows="5" name="post_content" placeholder="{{ $user->last_name }} ơi, bạn đang nghĩ gì thế  ?"></textarea>
                                </div>
                            </div>
                            <div id="post__media-preview" class="grid grid-cols-2 gap-2 p-2 max-h-[250px] overflow-y-auto"></div>
                            <div class="bottom-0 w-full p-4 space-x-4 bsolute">
                                <div class="flex items-center p-2 border border-purple-100 shadow-sm bg-gray-50 rounded-2xl">
                                    <span class="ml-1 text-sm">Thêm vào bài viết </span>
                                    <div class="flex items-center justify-end flex-1 space-x-2">
                                        <label for="post_media">
                                            <input multiple type="file" name="post_media[]" id="post_media" class="sr-only" />
                                            <img src="{{ IMG_PATH }}icon/post-icon.png" class="w-10 h-auto">
                                        </label>
                                        <div class="dropdown dropdown-top dropdown-end">
                                            <label tabindex="0"><img src="{{ IMG_PATH }}icon/tag-icon.png" class="h-auto w-11"></label>
                                            <ul tabindex="0" class="dropdown-content flex flex-col gap-1 p-2 shadow bg-gray-100 dark:bg-base-100 rounded-box w-fit min-w-[200px]">
                                                <div class="friend sm:max-h-[120px] overflow-y-auto p-1 hidden__scrollbar">
                                                    <div class="flex items-center gap-2 p-1">
                                                        <input type="checkbox" class="w-5 h-5 ">
                                                        <div class="flex items-center gap-2">
                                                            <img src="{{ IMG_PATH }}avatars/avatar-6.jpg" class="object-cover rounded-full w-7 h-7">
                                                            <span class="text-xs font-medium "> Erica Jones Erica Jones </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="search" name="search_friend" id="search_friend" class="w-full h-10 px-2 text-xs border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" placeholder="Tìm kiếm bạn bè">
                                            </ul>
                                        </div>
                                        <label> <img src="{{ IMG_PATH }}icon/locaiton-icon.png" class="w-10 h-auto"></label>
                                        <div class="dropdown dropdown-top dropdown-end">
                                            <label tabindex="0"><img src="{{ IMG_PATH }}icon/feelings.png" class="w-10 h-auto "></label>
                                            <div tabindex="0" class="dropdown-content p-2 shadow bg-gray-100 dark:bg-base-100 rounded-box w-fit min-w-[200px] flex flex-col gap-1">
                                                <h1 class="text-sm font-semibold text-center"> Bạn cảm thấy thế nào ? </h1>
                                                <div class="max-h-[160px] border-t sm:max-h-[120px] overflow-y-auto p-1 hidden__scrollbar">
                                                    <div class="flex items-center gap-2 p-1">
                                                        <input type="radio" class="w-5 h-5 ">
                                                        <div class="flex items-center gap-2">
                                                            <img src="{{ IMG_PATH }}icon/feelings.png" class="object-cover rounded-full w-7 h-7">
                                                            <span class="text-sm font-medium text-black dark:text-white"> Vui vẻ
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end w-full p-3 border-t whitespace-nowrap">
                                <button id="create__post-btn" type="submit" data-user-id="{{ $user->id }}" class="w-full px-5 font-medium text-white bg-yellow-500 rounded-md h-9">
                                    Chia sẻ </button>
                            </div>
                        </form>
                    </div>

                    <section id="list__posts" class="flex flex-col gap-5">
                        @foreach ($posts as $post)
                        <!-------------------------- Post ---------------------------->
                        <section id="posts-{{ $post->post_id }}" class="mb-6 bg-white rounded-lg shadow">
                            <div class="flex justify-between">
                                <div class="flex flex-row px-2 py-3 mx-3">

                                    <div class="w-auto h-auto rounded-full">
                                        <img class="object-cover w-12 h-12 rounded-full shadow cursor-pointer skeleton" alt="User avatar" src="{{ empty($post->avatar) ? AVATAR_PATH . 'default-avatar.jpg' : AVATAR_PATH . $post->avatar }}" alt="profile">
                                    </div>
                                    <div class="flex flex-col mt-1 mb-2 ml-4">
                                        <a href="#" class="text-sm font-semibold text-gray-900 skeleton dark:text-gray-100">
                                            {{ $post->first_name . ' ' . $post->last_name }}
                                        </a>
                                        <div class="flex w-full mt-1">
                                            <span class="mr-1 text-xs text-blue-700 cursor-pointer skeleton font-base">
                                                {{ $post->username }}
                                            </span>
                                            <span class="text-xs text-gray-400 skeleton">
                                                • {{ timeAgo($post->post_date) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 options-post">
                                    <a href="#"> <i class="p-2 -mr-1 text-2xl transition rounded-full icon-feather-more-horizontal hover:bg-gray-200 dark:hover:bg-gray-700"></i>
                                    </a>
                                    <div class="hidden w-56 p-2 mx-auto mt-12 text-base text-gray-500 bg-white border border-gray-100 rounded-md shadow-md dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">
                                        <ul class="space-y-1">
                                            @if ($user->id == $post->user_id || $user->role == 1)
                                            <li>
                                                <a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-900 dark:text-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>

                                                    Chỉnh sửa bài viết
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">
                                                    <svg class="w-5 h-5 fill-black dark:fill-white" viewBox="0 0 48 48">
                                                        <path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path>
                                                    </svg>
                                                    Tắt bình luận
                                                </a>
                                            </li>

                                            <li>
                                                <hr class="my-2 -mx-2 border-gray-300 dark:border-gray-500" />
                                            </li>
                                            <li>
                                                <a data-post-id="{{ $post->post_id }}" data-user-id="{{ $user->id }}" href="{{ route('posts/delete/' . $post->post_id) }}" class="flex items-center gap-3 p-2 text-red-500 rounded-md hover:bg-red-100 hover:text-white dark:hover:bg-red-600 delete__post-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>

                                                    Xóa bài viết
                                                </a>
                                            </li>
                                            @else
                                            <li>
                                                <a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-900 dark:text-white">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                                                    </svg>
                                                    Báo cáo bài viết
                                                </a>
                                            </li>
                                            @endif
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            @if (!empty($post->post_content))
                            <a href="#post__detail-{{ $post->post_id }}" uk-toggle>
                                <pre class="max-w-full px-3 pt-3 text-sm text-gray-900 skeleton dark:text-gray-100 font-sunbee">
                                {{ $post->post_content }}
                                </pre>
                            </a>
                            @endif
                            @if (count($post->medias) > 0)
                            <div class="text-sm font-medium text-gray-400 ">
                                <div uk-lightbox>
                                    <div class="swiper postMedia">
                                        <div class="swiper-wrapper postMedia-{{ $post->post_id }}">
                                            @foreach ($post->medias as $media)
                                            @if (isImage($media->post_media))
                                            <div class="swiper-slide skeleton">
                                                <a href="{{ POST_MEDIA_PATH . $media->post_media }}" class="col-span-2 ">
                                                    <img src="{{ POST_MEDIA_PATH . $media->post_media }}" alt="" class="w-full h-full ">
                                                </a>
                                            </div>
                                            @else
                                            <div class="swiper-slide skeleton">
                                                <video class="w-full h-full" controls>
                                                    <source src="{{ POST_MEDIA_PATH . $media->post_media }}" type="video/mp4">
                                                </video>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                                <div class="flex gap-5">
                                    <svg data-post-id="{{ $post->post_id }}" data-user-id="{{ $_SESSION['auth']->id }}" class="w-6 h-6 fill-black dark:fill-white like__post-btn like__post-btn-{{ $post->post_id }}  @if ($post->is_liked) active @endif" height="24" viewBox="0 0 48 48" width="24">

                                        <path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                                        </path>
                                    </svg>

                                    <a href="#post__detail-{{ $post->post_id }}" uk-toggle>
                                        <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 48 48">
                                            <path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 48 48">
                                        <path d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z">
                                        </path>
                                    </svg>
                                </div>
                                <svg data-post-id="{{ $post->post_id }}" data-user-id="{{ $_SESSION['auth']->id }}" class="w-6 h-6 save__post-btn  save__post-btn-{{ $post->post_id }} fill-black dark:fill-white @if ($post->is_saved) active @endif" viewBox="0 0 48 48">
                                    <path d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex w-full text-gray-900 border-t border-gray-100 dark:text-gray-100">
                                <div class="flex w-full mx-5 mt-3 text-xs skeleton">
                                    <div class="font-semibold like__post">
                                        <span class="like__post-count-{{ $post->post_id }} ">
                                            {{ intval($post->like_count) }}</span> lượt thích
                                    </div>
                                </div>
                                <div class="flex flex-row mx-5 mt-3 text-xs whitespace-nowrap skeleton">
                                    <div class="font-semibold share__post">
                                        <span class="share__post-count-{{ $post->post_id }}">
                                            {{ intval($post->share_count) }}</span> lượt chia sẻ
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 pb-3 text-xs text-[#737373] dark:text-gray-400 comment__post px-5 ">
                                <a href="#post__detail-{{ $post->post_id }}" uk-toggle class="skeleton">
                                    Xem <span class="post__comment-count-{{ $post->post_id }}">{{ intval($post->comment_count) }}</span>
                                    bình luận
                                </a>
                            </div>
                            <!-- ---------------------------POSTS DETAIL------------------------------ -->
                            <div id="post__detail-{{ $post->post_id }}" class="uk-modal-container glassmorphism__dark" uk-modal>
                                <div class="bg-white uk-modal-dialog dark:bg-gray-900">
                                    <button class="p-4 -mt-5 -mr-5 transition bg-white rounded-full shadow-lg uk-modal-close-default lg:-mt-9 lg:-mr-9 glassmorphism" type="button" uk-close></button>
                                    <div class="w-full mx-auto sm:max-w-3xl md:max-w-full lg:max-w-screen-xl">
                                        <div class="@if (count($post->medias) > 0) grid md:grid-cols-2 @endif">
                                            <div>
                                                <!-- ------------------------------DETAIL POSTS MEDIA---------------------------- -->
                                                <section class=" max-w-xs  xs:max-w-[370px]  sm:max-w-2xl md:max-w-3xl lg:max-w-screen-xl swiper sliderPosts ">
                                                    <div uk-lightbox class=" swiper-wrapper">
                                                        @foreach ($post->medias as $media)
                                                        <div class="flex items-center bg-white w-fit swiper-slide ">
                                                            <a href="{{ POST_MEDIA_PATH . $media->post_media }}">
                                                                @if (isImage($media->post_media))
                                                                <img src="{{ POST_MEDIA_PATH . $media->post_media }}" alt="Mở ảnh" class=" w-full  mx-auto h-full min-h-[320px] max-h-[320px] xs:min-h-[355px] xs:max-h-[355px] sm:min-h-[400px] sm:max-h-[400px] md:min-h-[500px] md:max-h-[500px]  object-cover" />
                                                                @else
                                                                <video class=" w-full  mx-auto h-full min-h-[320px] max-h-[320px] xs:min-h-[355px] xs:max-h-[355px] sm:min-h-[400px] sm:max-h-[400px] md:min-h-[500px] md:max-h-[500px]  object-contain" controls>
                                                                    <source src="{{ POST_MEDIA_PATH . $media->post_media }}" type="video/mp4" />
                                                                </video>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </section>
                                                <!-- ------------------------------END DETAIL POSTS MEDIA----------------------------- -->
                                            </div>
                                            <!-- -------------------------------DETAIL POSTS CONTENT---------------------------------- -->
                                            <section class="  flex flex-col max-h-[500px] details__posts justify-between">
                                                <!-- --------------------------------AUTHOR INFO--------------------------------- -->
                                                <div class="relative flex flex-col overflow-y-auto hidden__scrollbar">
                                                    <div class="flex items-center gap-2 px-5 py-2 author">
                                                        <div class="avatar">
                                                            <div class="w-10 h-10 bg-gray-200 rounded-full">
                                                                <img src="{{ AVATAR_PATH . $post->avatar }}" />
                                                            </div>
                                                        </div>
                                                        <div class="author__name">
                                                            <a href="#" class="text-sm text-[#262626] dark:text-white font-semibold">{{ $post->first_name . ' ' . $post->last_name }}</a>
                                                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                                                {{ timeAgo($post->post_date) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- -------------------------------END AUTHOR INFO--------------------------------- -->
                                                    <pre id="post__content-{{ $post->post_id }}" class="font-sunbee  px-4 pt-2 pb-3  whitespace-normal text-sm text-[#000000] dark:text-white ">
                                                    {{ $post->post_content }}
                                                    </pre>
                                                    <div class="flex items-center justify-between p-4 border-t border-b border-gray-200 dark:border-gray-700">
                                                        <div class="flex gap-5">
                                                            <svg data-post-id="{{ $post->post_id }}" data-user-id="{{ $_SESSION['auth']->id }}" class="w-6 h-6 fill-black dark:fill-white like__post-btn like__post-btn-{{ $post->post_id }} @if ($post->is_liked) active @endif" height="24" viewBox="0 0 48 48" width="24">

                                                                <path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                                                                </path>
                                                            </svg>

                                                            <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 48 48">
                                                                <path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path>
                                                            </svg>
                                                            <svg class="w-6 h-6 fill-black dark:fill-white" viewBox="0 0 48 48">
                                                                <path d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <svg data-post-id="{{ $post->post_id }}" data-user-id="{{ $user->id }}" class="w-6 h-6 save__post-btn   save__post-btn-{{ $post->post_id }} fill-black dark:fill-white @if ($post->is_saved) active @endif" viewBox="0 0 48 48">
                                                            <path d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <section class="my-2 flex items-center justify-between text-[#000000] total-interact dark:text-white px-4">
                                                        <div class="pb-2 text-sm font-semibold like__post">
                                                            <span class="like__post-count-{{ $post->post_id }}">{{ $post->like_count }}</span>
                                                            lượt thích
                                                        </div>
                                                        <div class="pb-2 text-sm font-semibold share__post">
                                                            <span class="share__post-count-{{ $post->post_id }}">{{ $post->share_count }}</span>
                                                            chia sẻ
                                                        </div>
                                                    </section>
                                                    <!-- ---------------------------OPTIONS DETAIL POSTS---------------------------- -->
                                                    <div class="absolute details__post-options top-3 right-10">
                                                        <div class="dropdown dropdown-end">
                                                            <label tabindex="{{ $post->post_id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900 dark:text-white">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                                </svg>
                                                            </label>
                                                            <ul tabindex="{{ $post->post_id }}" class="bg-white shadow dropdown-content dark:bg-base-100 rounded-xl">
                                                                <div class="w-48 p-2 text-sm text-gray-500 bg-white border border-gray-100 rounded-md dark:bg-base-100 dark:text-gray-100 dark:border-gray-700">
                                                                    <ul class="space-y-1">
                                                                        @if ($user->id == $post->user_id || $user->role == 1)
                                                                        <li>
                                                                            <a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-900 dark:text-white">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                </svg>

                                                                                Chỉnh sửa bài viết
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">
                                                                                <svg class="w-5 h-5 fill-black dark:fill-white" viewBox="0 0 48 48">
                                                                                    <path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path>
                                                                                </svg>
                                                                                Tắt bình luận
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <hr class="my-2 -mx-2 border-gray-300 dark:border-gray-500" />
                                                                        </li>
                                                                        <li>
                                                                            <a data-post-id="{{ $post->post_id }}" data-user-id="{{ $user->id }}" href="{{ route('posts/delete/' . $post->post_id) }}" class="flex items-center gap-3 p-2 text-red-500 rounded-md hover:bg-red-100 hover:text-white dark:hover:bg-red-600 delete__post-btn">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                </svg>

                                                                                Xóa bài viết
                                                                            </a>
                                                                        </li>
                                                                        @else
                                                                        <li>
                                                                            <a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-900 dark:text-white">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                                                                                </svg>
                                                                                Báo cáo bài viết
                                                                            </a>
                                                                        </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </ul>
                                                        </div>
                                                    </div>


                                                    <!-- --------------------------------DETAIL POSTS COMMENTS---------------------- -->
                                                    <section class="post__list-comments-{{ $post->post_id }} flex flex-col gap-3 min-h-[220px] max-h-[250px]">
                                                        @if ($post->comment_count < 1) <div class="no__comment-{{ $post->post_id }} flex flex-col items-center justify-center mx-auto mt-20 text-sm text-center text-gray-500 empty__comment dark:text-gray-400">

                                                            <span class="no__comment-{{ $post->post_id }}">Chưa có
                                                                bình luận nào</span>

                                                </div>
                                                @else
                                                @foreach ($post->comments as $comment)
                                                <!-- ------------------------------COMMENTS------------------------- -->
                                                <div id="post__comment-{{ $comment->comment_id }}" class="flex gap-2 p-4">
                                                    <div class="relative flex-shrink-0 w-10 h-10 rounded-full">
                                                        <img src="{{ empty($comment->avatar) ? AVATAR_PATH . 'default-avatar.jpg' : AVATAR_PATH . $comment->avatar }}" alt="" class="absolute object-cover w-full h-full rounded-full">
                                                    </div>
                                                    <div class="relative">
                                                        <div class="absolute top-0 comment-options right-5">
                                                            <div class="z-50 dropdown dropdown-end">
                                                                <label tabindex="{{ $comment->comment_id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900 dark:text-white">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                                    </svg>
                                                                </label>
                                                                <div tabindex="{{ $comment->comment_id }}" class="bg-white shadow dropdown-content dark:bg-base-100 rounded-xl">
                                                                    <ul tabindex="{{ $comment->comment_id }}" class="bg-white shadow dropdown-content dark:bg-base-100 rounded-xl">

                                                                        <div class="w-48 p-2 text-sm text-gray-500 bg-white border border-gray-100 dark:bg-base-100 rounded-xl dark:text-gray-100 dark:border-gray-700">
                                                                            <ul class="space-y-1">
                                                                                @if ($user->id === $comment->user_id || $user->role == 1)
                                                                                <li>
                                                                                    <span onclick="comment__{{ $comment->comment_id }}.showModal()" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">

                                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-900 dark:text-white">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                        </svg>

                                                                                        Chỉnh sửa bình
                                                                                        luận
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#" data-comment-id="{{ $comment->comment_id }}" data-post-id="{{ $post->post_id }}" data-user-id="{{ $post->user_id }}" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">

                                                                                        <svg class="w-5 h-5 fill-black dark:fill-white" viewBox="0 0 48 48">
                                                                                            <path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd">
                                                                                            </path>
                                                                                        </svg>
                                                                                        Tắt bình luận
                                                                                    </a>
                                                                                </li>

                                                                                <li>
                                                                                    <hr class="my-2 -mx-2 border-gray-300 dark:border-gray-500" />
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#" data-comment-id="{{ $comment->comment_id }}" data-post-id="{{ $post->post_id }}" class="flex items-center gap-3 px-2 py-1 text-red-500 rounded-md hover:bg-red-100 hover:text-white dark:hover:bg-red-600 delete__comment-btn">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                        </svg>
                                                                                        Xóa bình luận
                                                                                    </a>
                                                                                </li>
                                                                                @else
                                                                                <li>
                                                                                    <a href="#" data-comment-id="{{ $comment->comment_id }}" data-post-id="{{ $post->post_id }}" data-user-id="{{ $post->user_id }}" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">

                                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-900 dark:text-white">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                                                                                        </svg>
                                                                                        Báo cáo bình
                                                                                        luận
                                                                                    </a>
                                                                                </li>
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="px-3 py-2 w-fit min-w-[150px] text-gray-800 bg-gray-100 rounded-lg lg:mr-12 dark:bg-slate-800 border dark:text-gray-100 relative">
                                                            <a href="" class="text-sm font-semibold ">
                                                                {{ $comment->first_name . ' ' . $comment->last_name }}</a>

                                                            <p class="text-sm leading-6 ">
                                                                {{ $comment->comment_content }}
                                                            </p>
                                                            <div class="absolute flex items-center gap-1 pr-1 bg-gray-100 rounded-lg react__comment right-2 dark:bg-gray-700">
                                                                <img class="w-3.5 h-3.5 rounded-full object-contain " src="{{ IMG_PATH }}icon/tym-icon.png" alt="">
                                                                <span class="text-xs font-medium like__comment-count-{{ $comment->comment_id }}">{{ $comment->like_count }}</span>
                                                            </div>
                                                        </div>
                                                        @if ($comment->comment_media)
                                                        <div uk-lightbox class="mt-2 comment__media">
                                                            <a href="{{ COMMENT_MEDIA_PATH . $comment->comment_media }}">
                                                                @if (isImage($comment->comment_media))
                                                                <img src="{{ COMMENT_MEDIA_PATH . $comment->comment_media }}" alt="" class="object-cover w-full rounded-lg max-w-[200px] sm:max-w-[300px] lg:max-w-[350px]">
                                                                @else
                                                                <video src="{{ COMMENT_MEDIA_PATH . $comment->comment_media }}" class="w-auto rounded-lg object-contain max-w-[200px] sm:max-w-[300px] lg:max-w-[350px]" controls></video>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        @endif
                                                        <div class="flex items-center mt-2 space-x-3 text-xs">
                                                            <a href="#" data-comment-id="{{ $comment->comment_id }}" data-user-id="{{ $post->user_id }}" class="hover:text-red-500 like__comment-btn like__comment-btn-{{ $comment->comment_id }}">Thích</a>
                                                            <span class="hover:text-yellow-500"> Phản
                                                                hồi </span>
                                                            <span class="hover:text-yellow-500">
                                                                {{ timeAgo($comment->comment_date) }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <dialog id="comment__{{ $comment->comment_id }}" class="modal">
                                                    <form method="dialog" class="bg-gray-300 modal-box dark:bg-gray-900">
                                                        <div class="flex form-group">
                                                            <div class="user ">
                                                                <img class="absolute object-cover w-10 h-10 mr-3 rounded-full" src="{{ AVATAR_PATH }}{{ $user->avatar }}" alt="">
                                                            </div>
                                                            <textarea name="comment_content" class="px-2 py-2 bg-gray-300 border border-gray-300 rounded outline-none w-fit dark:bg-gray-900 pl-11 focus:border-indigo-500 comment_content" placeholder="Nhập nội dung bình luận">{{ $comment->comment_content }}</textarea>
                                                        </div>
                                                        <div class="modal-action">
                                                            <button type="submit" class="btn btn-sm ">Hủy</button>
                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                Lưu
                                                            </button>
                                                        </div>
                                                    </form>
                                                </dialog>
                                                <!-- ------------------------------END COMMENTS------------------------- -->
                                                @endforeach
                                                @endif
                                            </section>
                                        </div>
                                        <!-- ------------------------------------ADD COMMENT -------------------------- -->
                                        <form method="post" class="relative flex items-center self-center w-full p-4 overflow-hidden text-gray-600 focus-within:text-gray-400 add__comment-{{ $post->post_id }}">
                                            <img class="object-cover w-10 h-10 mr-2 rounded-full shadow cursor-pointer" alt="User avatar" src="{{ AVATAR_PATH . $user->avatar }}">
                                            <span class="absolute inset-y-0 right-0 flex items-center gap-2 pr-5 md:gap-3">
                                                <svg class="w-6 h-6 text-gray-400 transition duration-300 ease-out hover:text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>


                                                <label for="comment_media-{{ $post->post_id }}" class="mt-1.5">
                                                    <input data-post-id="{{ $post->post_id }}" id="comment_media-{{ $post->post_id }}" type="file" name="comment_media" class="sr-only comment__media-upload" accept=" image/*,video/*" />
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400 transition duration-300 ease-out hover:text-yellow-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                                    </svg>
                                                </label>
                                                <button type="submit" data-post-id="{{ $post->post_id }}" data-user-id="{{ $user->id }}" class="focus:outline-none focus:shadow-none add__comment-btn">
                                                    <svg class="w-5 h-5 transition duration-300 ease-out fill-gray-400 hover:fill-yellow-500" viewBox="0 0 48 48">
                                                        <path d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </span>
                                            <input type="search" id="comment_content-{{ $post->post_id }}" class="w-full py-2 pl-4 pr-10 text-sm placeholder-gray-400 border border-transparent appearance-none rounded-tg" style="border-radius: 25px" placeholder="Nhập bình luận ..." autocomplete="off">
                                        </form>
                                        <div id="comment__media-preview-{{ $post->post_id }}" class="hidden w-20 h-auto mb-3 ml-3">
                                        </div>
                        </section>
                    </section>
                    @endforeach
                    </section>
                </div>

                <!-- Sidebar -->
                <div class="w-full space-y-6">

                    <div class="widget card p-5">
                        <h4 class="text-lg font-semibold"> Giới thiệu </h4>
                        <ul class="text-gray-600 space-y-3 mt-3">
                            <li class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                Sống tại <strong> {{ $user->address }}</strong>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                                Tham gia từ <strong> {{ date('d/m/Y', strtotime($user->created_at)) }}</strong>
                            </li>

                            <li class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 19.5v-.75a7.5 7.5 0 00-7.5-7.5H4.5m0-6.75h.75c7.87 0 14.25 6.38 14.25 14.25v.75M6 18.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                                Có <strong class="mr-0.5"> 1.000.000 </strong> người theo dõi
                            </li>
                        </ul>
                        <div class="gap-3 grid grid-cols-3 mt-4">
                            <img src="assets/images/avatars/avatar-lg-2.jpg" alt="" class="object-cover rounded-lg col-span-full">
                            <img src="assets/images/avatars/avatar-2.jpg" alt="" class="rounded-lg">
                            <img src="assets/images/avatars/avatar-4.jpg" alt="" class="rounded-lg">
                            <img src="assets/images/avatars/avatar-5.jpg" alt="" class="rounded-lg">
                        </div>
                        <a href="#" class="button gray mt-3 w-full"> Chỉnh sửa </a>
                    </div>

                    <div class="widget card p-5 border-t">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h4 class="text-lg font-semibold"> Bạn bè</h4>
                                <p class="text-sm"> {{ count($friends) }} người bạn</p>
                            </div>
                            <a href="#" class="text-blue-600 ">Xem tất cả</a>
                        </div>
                        <div class="grid grid-cols-3 gap-3 text-gray-600 font-semibold">
                            @foreach($friends as $friend)
                            <a href="{{ route('profile/'.$friend->username) }}">
                                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2">
                                    <img src="{{ AVATAR_PATH }}{{ $friend->avatar }}" alt="" class="w-full h-full object-cover absolute">
                                </div>
                                <div class="text-sm truncate"> {{ $friend->first_name }} {{ $friend->last_name }}</div>
                            </a>
                            @endforeach
                        </div>
                        <a href="#" class="button gray mt-3 w-full"> Xem tất cả </a>
                    </div>

                    <div class="widget card p-5 border-t">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <h4 class="text-lg font-semibold"> Groups </h4>
                            </div>
                            <a href="#" class="text-blue-600 "> See all</a>
                        </div>
                        <div>

                            <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                                <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                    <img src="assets/images/group/group-3.jpg" class="absolute w-full h-full inset-0 " alt="">
                                </a>
                                <div class="flex-1">
                                    <a href="timeline-page.html" class="text-base font-semibold capitalize"> Graphic Design </a>
                                    <div class="text-sm text-gray-500 mt-0.5"> 345K Following</div>
                                </div>
                                <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                    Join
                                </a>
                            </div>
                            <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                                <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                    <img src="assets/images/group/group-4.jpg" class="absolute w-full h-full inset-0 " alt="">
                                </a>
                                <div class="flex-1">
                                    <a href="timeline-page.html" class="text-base font-semibold capitalize"> Mountain Riders </a>
                                    <div class="text-sm text-gray-500 mt-0.5"> 452k Following </div>
                                </div>
                                <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                    Join
                                </a>
                            </div>
                            <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                                <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                    <img src="assets/images/group/group-2.jpg" class="absolute w-full h-full inset-0" alt="">
                                </a>
                                <div class="flex-1">
                                    <a href="timeline-page.html" class="text-base font-semibold capitalize"> Coffee Addicts </a>
                                    <div class="text-sm text-gray-500 mt-0.5"> 845K Following</div>
                                </div>
                                <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                    Join
                                </a>
                            </div>
                            <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                                <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                    <img src="assets/images/group/group-1.jpg" class="absolute w-full h-full inset-0" alt="">
                                </a>
                                <div class="flex-1">
                                    <a href="timeline-page.html" class="text-base font-semibold capitalize"> Architecture </a>
                                    <div class="text-sm text-gray-500 mt-0.5"> 237K Following</div>
                                </div>
                                <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                    Join
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Friends  -->
            <section class="card md:p-6 p-2 max-w-3xl mx-auto">
                <div class="flex justify-between">
                    <h2 class="text-xl font-bold"> Bạn bè gần đây</h2>
                    <a href="#" class="text-blue-600"> Xem tất cả</a>
                </div>
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 mt-3">
                    @foreach($friends as $friend)
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="{{ AVATAR_PATH }}{{ $friend->avatar }}" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5">{{ $friend->first_name }} {{ $friend->last_name }} </a>
                            <p class="font-medium text-sm">{{ $friend->username }}</p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Hủy kết bạn
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Photos  -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <div class="flex justify-between items-start relative md:mb-4 mb-3">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold"> Ảnh </h2>
                        <nav class="responsive-nav style-2 md:m-0 -mx-4">
                            <ul>
                                <li class="active"><a href="#"> Ảnh của {{ $user->first_name }}<span> {{ count($medias) }}</span> </a></li>
                            </ul>
                        </nav>
                    </div>
                    <a href="#offcanvas-create" uk-toggle class="flex items-center justify-center z-10 h-10 w-10 rounded-full bg-blue-600 text-white absolute right-0" data-tippy-placement="left" title="Create New Album">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                @if(count($medias) > 0)
                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-3 mt-5">
                    @foreach($medias as $media)
                    <div>
                        <div class="bg-green-400 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle" uk-lightbox>
                            <a href="{{ POST_MEDIA_PATH }}{{ $media->post_media }}">
                                <img src="{{ POST_MEDIA_PATH }}{{ $media->post_media }}" class="w-full h-full absolute object-cover inset-0">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <h1 class="text-center">Không có ảnh nào</h1>
                @endif
            </div>

            <!-- Pages  -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <h2 class="text-xl font-bold"> Trang</h2>
                <nav class="responsive-nav border-b md:m-0 -mx-4">
                    <ul>
                        <li class="active"><a href="#" class="lg:px-2"> Following </a></li>
                        <li><a href="#" class="lg:px-2"> Newest </a></li>
                        <li><a href="#" class="lg:px-2"> My pages</a></li>
                        <li><a href="#" class="lg:px-2"> Suggestions</a></li>
                    </ul>
                </nav>

                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4 mt-5">

                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-4.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> John Michael </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-3.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5">
                                Alex Dolgove </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-5.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> Dennis Han </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-7.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> Monroe Parker </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-6.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> Erica Jones </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-2.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> Stella Johnson</a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-4.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> John Michael </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-3.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5">
                                Alex Dolgove </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>

                </div>

                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Load more ..</a>
                </div>

            </div>

            <!-- Groups  -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <div class="flex justify-between items-start relative md:mb-4 mb-3">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold"> Groups </h2>
                        <nav class="responsive-nav style-2 md:m-0 -mx-4">
                            <ul>
                                <li class="active"><a href="#"> Joined <span> 230</span> </a></li>
                                <li><a href="#"> My Groups </a></li>
                                <li><a href="#"> Discover </a></li>
                            </ul>
                        </nav>
                    </div>
                    <a href="create-group.html" data-tippy-placement="left" data-tippy="" data-original-title="Create New Album" class="bg-blue-100 font-semibold py-2 px-6 rounded-md text-sm md:mt-0 mt-3 text-blue-600">
                        Create
                    </a>
                </div>

                <div class="grid md:grid-cols-2  grid-cols-2 gap-x-2 gap-y-4 mt-3">

                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-3.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize">Graphic Design </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-4.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Mountain Riders </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-2.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Coffee Addicts </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-5.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Property Rent </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-1.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Architecture </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-3.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize">Graphic Design </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-4.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Mountain Riders </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-2.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Coffee Addicts </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>

                </div>

                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md  dark:text-white">
                        Load more ..</a>
                </div>

            </div>

            <!-- Videos -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <h2 class="text-xl font-semibold"> Friend</h2>
                <nav class="responsive-nav border-b">
                    <ul>
                        <li class="active"><a href="#" class="lg:px-2"> Suggestions </a></li>
                        <li><a href="#" class="lg:px-2"> Newest </a></li>
                        <li><a href="#" class="lg:px-2"> My Videos </a></li>
                    </ul>
                </nav>

                <div class="grid md:grid-cols-3 grid-cols-2  gap-x-2 gap-y-4 mt-3">
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-1.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-2.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-3.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-4.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-5.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>

                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-6.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-3.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-2.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-4.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Load more ..</a>
                </div>

            </div>


        </div>

    </div>
</div>
@endsection
