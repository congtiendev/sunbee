@extends('admin.layouts.master')
@section('content')
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mx-auto max-w-242.5">
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-title-md2 font-bold text-black dark:text-white">
                        Trang cá nhân
                    </h2>
                </div>

                <div
                    class="overflow-hidden rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="relative z-20 h-35 md:h-65">
                        <img src="{{ empty($user->cover_photo) ? COVER_PATH . 'default-cover-photo.jpg' : COVER_PATH . $user->cover_photo }}"
                            alt="profile" alt="profile cover"
                            class="h-full w-full rounded-tl-sm rounded-tr-sm object-cover object-center" />
                        <div class="absolute bottom-1 right-1 z-10 xsm:bottom-4 xsm:right-4">
                            <label for="change-cover-photo"
                                class="flex cursor-pointer items-center justify-center gap-2 rounded bg-primary py-1 px-2 text-sm font-medium text-white hover:bg-opacity-80 xsm:px-4">
                                <span>
                                    <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.99992 5.83329C6.03342 5.83329 5.24992 6.61679 5.24992 7.58329C5.24992 8.54979 6.03342 9.33329 6.99992 9.33329C7.96642 9.33329 8.74992 8.54979 8.74992 7.58329C8.74992 6.61679 7.96642 5.83329 6.99992 5.83329ZM4.08325 7.58329C4.08325 5.97246 5.38909 4.66663 6.99992 4.66663C8.61075 4.66663 9.91659 5.97246 9.91659 7.58329C9.91659 9.19412 8.61075 10.5 6.99992 10.5C5.38909 10.5 4.08325 9.19412 4.08325 7.58329Z"
                                            fill="white" />
                                    </svg>
                                </span>
                                <span>Thay đổi</span>
                            </label>
                        </div>
                    </div>
                    <!-- --------------------------------Change cover photo------------------------------------ -->
                    <input type="checkbox" id="change-cover-photo" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <form action="{{ route('admin/change-cover-photo/' . $user->id) }}" method="post"
                            enctype="multipart/form-data" class="modal-box bg-gray-100 dark:bg-boxdark">
                            <label id="upload-cover-photo-label" for="upload-cover-photo"
                                class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>

                                <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">
                                    Thay đổi ảnh bìa
                                </h2>

                                <p class="mt-2 text-gray-500 tracking-wide">
                                    Tải lên ảnh bìa mới của bạn
                                </p>
                                <input id="upload-cover-photo" name="cover_photo" type="file" class="hidden" />
                            </label>
                            <div id="cover-photo-preview" class="my-4 w-full h-auto"></div>
                            <div class="modal-action">
                                <label for="change-cover-photo" class="btn btn-error">Hủy</label>
                                <button name="change_cover_photo_btn" type="submit" class="btn btn-success">
                                    Lưu
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- ------------------------------------------------------------- -->
                    <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
                        <div
                            class="relative z-30 mx-auto -mt-22 w-full max-w-30 sm:max-w-44 sm:h-44 h-30 rounded-full bg-white/20 p-1 backdrop-blur first-letter:sm:p-3">
                            <div class="relative drop-shadow-2 w-full h-full">
                                <img class="rounded-full w-full h-full object-cover"
                                    src="{{ empty($user->avatar) ? AVATAR_PATH . 'default-avatar.jpg' : AVATAR_PATH . $user->avatar }}"
                                    alt="profile avatar" />
                                <label for="change-avatar"
                                    class="absolute bottom-0 right-0 flex h-8.5 w-8.5 cursor-pointer items-center justify-center rounded-full bg-primary text-white hover:bg-opacity-90 sm:bottom-2 sm:right-2">
                                    <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                            fill="" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.00004 5.83329C6.03354 5.83329 5.25004 6.61679 5.25004 7.58329C5.25004 8.54979 6.03354 9.33329 7.00004 9.33329C7.96654 9.33329 8.75004 8.54979 8.75004 7.58329C8.75004 6.61679 7.96654 5.83329 7.00004 5.83329ZM4.08337 7.58329C4.08337 5.97246 5.38921 4.66663 7.00004 4.66663C8.61087 4.66663 9.91671 5.97246 9.91671 7.58329C9.91671 9.19412 8.61087 10.5 7.00004 10.5C5.38921 10.5 4.08337 9.19412 4.08337 7.58329Z"
                                            fill="" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <!-- --------------------------Change avatar modal------------------------------- -->
                        <input type="checkbox" id="change-avatar" class="modal-toggle" />
                        <div class="modal modal-bottom sm:modal-middle">
                            <form method="post" action="{{ route('admin/change-avatar/' . $user->id) }}"
                                enctype="multipart/form-data" class="modal-box bg-gray-100 dark:bg-boxdark">
                                <label id="upload-avatar-label" for="upload-avatar"
                                    class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>

                                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">
                                        Thay đổi ảnh đại diện
                                    </h2>

                                    <p class="mt-2 text-gray-500 tracking-wide">
                                        Tải lên ảnh đại diện mới của bạn
                                    </p>
                                    <input id="upload-avatar" name="avatar" type="file" class="hidden" />
                                </label>
                                <div id="avatar-preview" class="my-4 w-full h-auto"></div>
                                <div class="modal-action">
                                    <label for="change-avatar" class="btn btn-error">Hủy</label>
                                    <button name="change_avatar_btn" type="submit" class="btn btn-success">
                                        Lưu
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- ------------------------------------------------------- -->
                        <div class="mt-4">
                            <h3 id="fullName" class="mb-1.5 text-2xl font-medium text-black dark:text-white">
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </h3>
                            <p id="username" class="font-medium">
                                {{ '@' . $user->username }}
                            </p>
                            <div
                                class="mx-auto mt-4.5 mb-5.5 grid max-w-[450px] whitespace-nowrap grid-cols-3 rounded-md border border-stroke py-2.5 shadow-1 dark:border-strokedark dark:bg-[#37404F]">
                                <div
                                    class="flex flex-col items-center justify-center gap-1 border-r border-stroke px-4 dark:border-strokedark xsm:flex-row">
                                    <span class="font-semibold text-black dark:text-white">259</span>
                                    <span class="text-sm">Bài đăng</span>
                                </div>
                                <div
                                    class="flex flex-col items-center justify-center gap-1 border-r border-stroke px-4 dark:border-strokedark xsm:flex-row">
                                    <span class="font-semibold text-black dark:text-white">129K</span>
                                    <span class="text-sm">Người theo dõi</span>
                                </div>
                                <div class="flex flex-col items-center justify-center gap-1 px-4 xsm:flex-row">
                                    <span class="font-semibold text-black dark:text-white">2K</span>
                                    <span class="text-sm">Đang theo dõi</span>
                                </div>
                            </div>

                            <div class="mx-auto max-w-180">
                                <p class="mt-4.5 text-sm font-medium">
                                    {{ $user->bio }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
