<aside class="sidebar">
    <div class="sidebar_inner" data-simplebar>
        <ul>
            <li class="active"><a href="feed.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/home-icon.png" />
                    <span class="skeleton"> Bảng tin</span> </a>

            </li>
            <li><a href="pages.html">
                    <img class="w-10 h-auto" src="{{IMG_PATH}}icon/flag-icon.png" />
                    <span class="skeleton"> Trang </span> </a>
            </li>
            <li><a href="videos.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/video-icon.png" />
                    <span class="skeleton"> Video</span></a>
            </li>
            <li><a href="groups.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/group-icon.png" />
                    <span class="skeleton">Nhóm</span></a>
            </li>
            <li><a href="jobs.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/job-icon.png" />
                    <span class="skeleton"> Jobs</span> </a>

            </li>

            <li><a href="games.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/game-icon.png" />
                    <span class="skeleton">Trò chơi </span></a>

            </li>

            <li hidden><a href="events.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/event-icon.png" />
                    <span class="skeleton"> Sự kiện </span></a>

            </li>
            <li class="more-view" hidden><a href="products.html">
                    <img class="h-auto mr-1 w-9" src="{{IMG_PATH}}icon/product-icon.png" />
                    <span class="skeleton"> Sản phẩm</span></a>

            </li>
            <li class="more-view" hidden><a href="blogs.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/blog-icon.png" />
                    <span class="skeleton"> Blog</span></a>

            </li>

            <li class="more-view" hidden><a href="birthdays.html">
                    <img class="w-8 h-auto mr-2" src="{{IMG_PATH}}icon/birthday-icon.png" />
                    <span class="skeleton"> Sinh nhật</span> <span class="new">N</span></a>

            </li>
        </ul>

        <a href="#" class="flex h-10 pl-2 my-1 text-gray-600 see-mover rounded-xl" uk-toggle="target: .more-view; animation: uk-animation-fade">
            <span class="flex items-center w-full more-view skeleton">
                <svg class=" bg-gray-100 mr-2 p-0.5 rounded-full text-lg w-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                Xem thêm
            </span>
            <span class="flex items-center w-full more-view" hidden>
                <svg class="bg-gray-100 mr-2 p-0.5 rounded-full text-lg w-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                </svg>
                Ẩn bớt
            </span>
        </a>


        <ul class="side_links" data-sub-title="Pages">
            <li><a href="feed.html">
                    <ion-icon name="settings-outline" class="side-icon"></ion-icon>
                    <span>Cài đặt </span>
                </a>
                <ul>
                    <li><a href="pages-setting.html">Cài đặt tài khoản</a></li>
                    <li><a href="pages-setting.html">Trợ giúp</a></li>
                </ul>
            </li>
            <li><a href="#">
                    <ion-icon name="albums-outline" class="side-icon"></ion-icon> <span>
                        Thông tin
                    </span>
                </a>
                <ul>
                    <li><a href="pages-about.html"> Về chúng tôi </a></li>
                    <li><a href="pages-contact.html"> Liên hệ</a></li>
                    <li><a href="pages-privacy.html"> Chính sách và điều khoản </a></li>
                </ul>
            </li>
        </ul>
        <div class="text-center mt-14 footer-links skeleton">
            <a href="#">&copy; CongTienDev, 2023</a>
        </div>
    </div>
    <!-- sidebar overly for mobile -->
    <div class="side_overly" uk-toggle="target: #wrapper ; cls: is-collapse is-active"></div>
</aside>
