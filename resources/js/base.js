const API_URL = "http://localhost:88/Sunbee-Social-Network/";
const pusher = new Pusher("c3271ec62a7f5d395eb3", {
  cluster: "ap1",
  useTLS: true,
});

$(window).on("load", function () {
  $("#loader-overlay").fadeOut("slow");
});

$(document).ready(function () {
  //===========================================Confirm delete avatar=======================================//

  $(".delete-avatar").on("click", function (e) {
    e.preventDefault();
    const id = $(this).data("id");
    swal({
      title: "Bạn có chắc chắn muốn xóa ảnh đại diện ?",
      text: "Ảnh đại diện của tài khoản này sẽ bị xóa.! ",
      icon: "warning",
      buttons: ["Hủy", "Xóa"],
      dangerMode: true,
    }).then(function (isConfirm) {
      if (isConfirm) {
        swal({
          title: "Đã xóa ảnh đại diện",
          icon: "success",
          timer: 1500,
        }).then(function () {
          window.location.href = API_URL + "admin/delete-avatar/" + id;
        });
      } else {
        swal(
          "Hủy xóa ảnh đại diện",
          "Ảnh đại diện của tài khoản này sẽ không bị xóa.",
          "info"
        );
      }
    });
  });

  //=============================================Check image url ===========================================//

  function isImageUrl(url) {
    const imageExtensions = [".jpg", ".jpeg", ".png", ".gif", ".bmp"];
    const extension = url.substring(url.lastIndexOf(".")).toLowerCase();
    return imageExtensions.includes(extension);
  }

  //==============================================Preview media==============================================//

  const uploadedFiles = []; // Mảng lưu trữ các tệp đã tải lên
  function previewMultiple(file, previewElementId, callback) {
    const previewElement = $(previewElementId);
    const previewContainer = $("<div>").addClass("preview-container relative");
    if (file) {
      const reader = new FileReader();
      reader.onload = function () {
        const mediaElement = $(
          "<" + (file.type.startsWith("video/") ? "video" : "img") + ">"
        ).addClass("w-full h-full object-cover rounded-md relative");
        mediaElement.attr("src", reader.result);
        if (file.type.startsWith("video/")) {
          mediaElement.prop("controls", true);
        }
        const removeButton = $("<button>").addClass(
          "remove-btn absolute top-0 right-0 cursor-pointer"
        );
        removeButton.html(
          '<img src="' +
            API_URL +
            'resources/images/icon/remove-icon.png" alt="close" class="w-7 h-7">'
        );
        removeButton.on("click", function () {
          // Xóa tệp khỏi mảng uploadedFiles
          const index = uploadedFiles.indexOf(file);
          if (index !== -1) {
            // Nếu tệp tồn tại trong mảng uploadedFiles
            uploadedFiles.splice(index, 1); // Xóa tệp khỏi mảng uploadedFiles
          }
          previewContainer.remove();
        });
        previewContainer.append(mediaElement);
        previewContainer.append(removeButton);
        previewElement.append(previewContainer);

        // Thêm tệp vào mảng uploadedFiles
        uploadedFiles.push(file);

        if (callback) {
          callback(previewContainer);
        }
      };
      reader.readAsDataURL(file);
    }
  }

  // ============================================Preview text================================================//

  function previewText(text, previewElementId) {
    const previewElement = document.querySelector(`#${previewElementId}`);
    previewElement.innerHTML = "";
    if (text) {
      const p = document.createElement("p");
      p.innerHTML = text;
      previewElement.appendChild(p);
    }
  }

  // ============================================CREATE POSTS=================================================//

  const postMediaUpload = $("#post_media");
  if (postMediaUpload.length) {
    postMediaUpload.on("change", function () {
      const files = postMediaUpload.get(0).files;
      if (files.length > 0) {
        for (let i = 0; i < files.length; i++) {
          const file = files[i];
          if (!uploadedFiles.includes(file)) {
            const previewMedia = "#post__media-preview";
            previewMultiple(file, previewMedia);
          }
        }
      }
    });
  }
  const createPostBtn = $("#create__post-btn");
  if (createPostBtn)
    $("#create__post-btn").on("click", function (event) {
      event.preventDefault();
      const user_id = $(this).data("user-id");
      const post_content = $("#post_content").val();
      const post_media = $("#post_media").prop("files");
      if (post_media.length == 0 && post_content.length == 0) {
        swal("Bài viết của bạn không có nội dung và hình ảnh", "", "error");
        return;
      }

      const formData = new FormData();
      formData.append("user_id", user_id);
      formData.append("post_content", post_content);
      formData.append("post_media", post_media);
      for (let i = 0; i < post_media.length; i++) {
        formData.append("post_media[]", post_media[i]);
        console.log(post_media[i]);
      }

      $.ajax({
        url: API_URL + "admin/posts/create",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);
          swal("Bài viết đã được đăng ", "", "success");
          setTimeout(function () {
            location.reload();
          }, 1000);
        },
        error: function (error) {
          console.log(error);
          swal("Đã có lỗi xảy ra", "", "error");
        },
      });
    });

  /* ===========================================Slider Post Media============================================= */

  if (document.querySelector(".sliderPosts")) {
    const swiper = new Swiper(".sliderPosts", {
      effect: "cards",
      grabCursor: true,
    });
  }

  /* ============================================Like post=======================================================*/

  const likeChannel = pusher.subscribe("like-post");

  // Xử lý sự kiện khi nhận được sự kiện like hoặc unlike từ Pusher
  likeChannel.bind("like", function (data) {
    const { post_id, user_id } = data;
    const likeCountElement = $(`#like-count-${post_id}`);

    // Cập nhật số lượng like trong giao diện người dùng
    likeCountElement.text(parseInt(likeCountElement.text()) + 1);
  });

  likeChannel.bind("unlike", function (data) {
    const { post_id, user_id } = data;
    const likeCountElement = $(`.like__post_count_${post_id}`);

    // Cập nhật số lượng like trong giao diện người dùng
    likeCountElement.text(parseInt(likeCountElement.text()) - 1);
  });

  let isProcessing = false; // Biến để kiểm tra xem xử lý đang diễn ra hay không

  $(".like__post-btn, .like__details-post-btn").on("click", function () {
    if (isProcessing) {
      return; // Nếu đang xử lý, không cho phép người dùng click tiếp
    }

    const postID = $(this).data("post-id");
    const userID = $(this).data("user-id");
    const postAction = $(`#post-action_${postID}`);
    const likePostBtn = postAction.find(".like__post-btn");
    const likePostCount = postAction.find(".like__post-count");
    const likeDetailsPostBtn = postAction.find(".like__details-post-btn");
    const likeDetailsPostCount = postAction.find(".like__details-post-count");
    let count = parseInt(likePostCount.text());

    if (
      likePostBtn.hasClass("active") &&
      likeDetailsPostBtn.hasClass("active")
    ) {
      count -= 1;
      likePostBtn.removeClass("active");
      likeDetailsPostBtn.removeClass("active");
      handleLikePost(postID, userID, "admin/posts/unlike-post");
    } else {
      count += 1;
      likePostBtn.addClass("active");
      likeDetailsPostBtn.addClass("active");
      handleLikePost(postID, userID, "admin/posts/like-post");
    }
    likePostCount.text(count);
    likeDetailsPostCount.text(count);

    isProcessing = true; // Đánh dấu rằng xử lý đang diễn ra

    // Tạm thời vô hiệu hóa nút "like" để ngăn người dùng click tiếp
    likePostBtn.prop("disabled", true);
    likeDetailsPostBtn.prop("disabled", true);

    // Đặt thời gian chờ trước khi cho phép người dùng click lại
    setTimeout(function () {
      isProcessing = false; // Đánh dấu rằng xử lý đã hoàn thành
      likePostBtn.prop("disabled", false); // Cho phép người dùng click lại
      likeDetailsPostBtn.prop("disabled", false);
    }, 1000); // Thời gian chờ (vd: 1 giây)
  });

  function handleLikePost(postID, userID, url) {
    $.ajax({
      url: API_URL + url,
      type: "POST",
      data: {
        postID: postID,
        userID: userID,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  //==============================================Save post=======================================================//

  $(".save__post-btn,.save__details-post-btn").on("click", function () {
    const postID = $(this).data("post-id");
    const userID = $(this).data("user-id");
    const postAction = $(`#post-action_${postID}`);
    const savePostBtn = postAction.find(".save__post-btn");
    const saveDetailsPostBtn = postAction.find(".save__details-post-btn");

    if (
      savePostBtn.hasClass("active") &&
      saveDetailsPostBtn.hasClass("active")
    ) {
      savePostBtn.removeClass("active");
      saveDetailsPostBtn.removeClass("active");
      handleSavePost(postID, userID, "admin/posts/unsave-post");
    } else {
      savePostBtn.addClass("active");
      saveDetailsPostBtn.addClass("active");
      handleSavePost(postID, userID, "admin/posts/save-post");
    }
  });

  function handleSavePost(postID, userID, url) {
    $.ajax({
      url: API_URL + url,
      type: "POST",
      data: {
        postID: postID,
        userID: userID,
      },
      success: function (response) {
        console.log(response);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  // =============================================Comment post====================================================//
  var commentMediaUpload = document.querySelectorAll(".comment_media_upload");
  if (commentMediaUpload) {
    commentMediaUpload.forEach((commentMedia, index) => {
      commentMedia.addEventListener("change", function () {
        let file = this.files[0];
        const post_id = $(this).data("post-id");
        let previewMedia = document.querySelector(
          `#comment__media-preview_${post_id}`
        );
        if (file) {
          previewMultiple(file, previewMedia);
        }
      });
    });
  }

  // Subscribe to the 'comments' channel
  const channel = pusher.subscribe("comments");
  // Event listener for 'new-comment' event
  channel.bind("new-comment", function (data) {
    // Handle the new comment data received in real-time
    console.log(data);
    const commentCount = $(`.comment__post-count_${data.post_id}`);
    let count = parseInt(commentCount.text());
    count += 1;
    commentCount.text(count);
    const commentElement = $(
      '<div id="comment__' +
        data.comment_id +
        '">' +
        '<div class="flex p-4 antialiased text-black relative">' +
        '<div class="absolute comment-options top-0 right-5">' +
        '<div class="dropdown dropdown-end z-50">' +
        '<label tabindex="' +
        data.comment_id +
        '">' +
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900 dark:text-white">' +
        '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />' +
        "</svg>" +
        "</label>" +
        '<div tabindex="' +
        data.comment_id +
        '" class="bg-white shadow dropdown-content dark:bg-base-100 rounded-xl">' +
        '<ul class="w-fit whitespace-nowrap text-xs text-gray-500 bg-white border border-gray-100 dark:bg-base-100 rounded-xl dark:text-gray-100 dark:border-gray-700 p-2 font-normal">' +
        "<li>" +
        '<a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">' +
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-900 dark:text-white">' +
        '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />' +
        "</svg>" +
        "Chỉnh sửa bình luận" +
        "</a>" +
        "</li>" +
        "<li>" +
        '<a href="#" class="flex items-center gap-3 p-1 rounded-md hover:bg-gray-100 text-[#000000] dark:text-white dark:hover:bg-gray-800">' +
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-900 dark:text-white">' +
        '<path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />' +
        "</svg>" +
        "Báo cáo bình luận" +
        "</a>" +
        "</li>" +
        "<li>" +
        '<hr class="my-1 border-gray-300 dark:border-gray-500" />' +
        "</li>" +
        "<li>" +
        '<span data-post-id="' +
        data.post_id +
        '" data-comment-id="' +
        data.comment_id +
        '" id="delete__comment_' +
        data.comment_id +
        '" class="flex items-center gap-3 p-1 text-red-500 rounded-md hover:bg-red-100 hover:text-white dark:hover:bg-red-600">' +
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">' +
        '<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />' +
        "</svg>" +
        "Xóa bình luận" +
        "</span>" +
        "</li>" +
        "</ul>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<img class="w-8 h-8 mt-1 mr-2 rounded-full object-cover user__avatar" src=' +
        data.avatar +
        " />" +
        "<div>" +
        '<a href="#" class="text-sm font-semibold leading-relaxed username dark:text-gray-100">' +
        data.username +
        "</a>" +
        (data.comment_content
          ? '<div class="w-fit bg-gray-100 dark:bg-gray-800 rounded-lg px-4 pt-2 pb-2.5">' +
            '<p class="text-xs leading-snug dark:text-gray-100 md:leading-normal">' +
            data.comment_content +
            "</p>" +
            "</div>"
          : "") +
        '<div class="comment_media_' +
        data.comment_id +
        ' w-[65%] h-auto my-1 rounded-lg"></div>' +
        '<span class="text-xs text-gray-500">' +
        data.comment_date +
        "</span>" +
        "</div>" +
        "</div>" +
        "</div>"
    );
    $(`#post__comments__${data.post_id}`).append(commentElement);

    if (data.comment_media != "") {
      const commentMedia = $(".comment_media_" + data.comment_id);
      if (isImageUrl(data.comment_media)) {
        commentMedia.append(
          '<img class="w-full h-auto rounded-lg" src=' +
            data.comment_media +
            " />"
        );
      } else {
        commentMedia.append(
          '<video class="w-full h-auto rounded-lg" controls>' +
            "<source src=" +
            data.comment_media +
            ' type="video/mp4">' +
            "</video>"
        );
      }
    }
  });
  $(".add__comment-btn").on("click", function (event) {
    event.preventDefault();
    const button = $(this);
    const post_id = button.data("post-id");
    const user_id = button.data("user-id");
    const comment_content = $(`#comment_content_input_${post_id}`).val();
    const comment_media = $(`#comment_media_upload_${post_id}`)[0].files;
    const addCommentBtn = $(`#add__comment-btn_${post_id}`);
    const commentLoading = $(`#comment__loading_${post_id}`);
    const commentBtnText = $(`#add__comment-btn-text_${post_id}`);
    const noComment = $(`#no__comment_${post_id}`);
    console.log(noComment);
    if (!comment_content && comment_media.length === 0) {
      return;
    }

    const form_data = new FormData();
    form_data.append("post_id", post_id);
    form_data.append("user_id", user_id);
    form_data.append("comment_content", comment_content);
    for (let i = 0; i < comment_media.length; i++) {
      form_data.append("comment_media", comment_media[i]);
    }

    $.ajax({
      url: API_URL + "admin/posts/add-comment",
      type: "POST",
      data: form_data,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $(`#comment_content_input_${post_id}`).val("");
        $(`#comment_media_upload_${post_id}`).val("");
        $(`#comment__media-preview_${post_id}`).html("");
        addCommentBtn.attr("disabled", true);
        commentLoading.removeClass("hidden");
        commentBtnText.addClass("hidden");
      },
      success: function (response) {
        console.log(response);
        noComment.remove();
        channel.trigger("client-new-comment", response); // Trigger the 'new-comment' event on the 'comments' channel
      },
      error: function (error) {
        console.log(error);
      },
      complete: function () {
        commentLoading.addClass("hidden");
        commentBtnText.removeClass("hidden");
        addCommentBtn.attr("disabled", false);
      },
    });
  });

  // ===============================================Delete comment====================================
  channel.bind("delete-comment", function (data) {
    console.log(data);
    const commentElement = $(`#comment__${data.comment_id}`);
    const commentCount = $(`.comment__post-count_${data.post_id}`);
    let count = parseInt(commentCount.text());
    count--;
    commentCount.text(count);
    commentElement.remove();
  });
  $(".delete__comment").on("click", function (e) {
    e.preventDefault();
    const comment_id = $(this).data("comment-id");
    const post_id = $(this).data("post-id");
    const user_id = $(this).data("user-id");
    deleteComment(post_id, comment_id);
  });

  function deleteComment(post_id, comment_id) {
    $.ajax({
      url: API_URL + "admin/posts/delete-comment/" + post_id + "/" + comment_id,
      type: "GET",
      success: function (response) {
        console.log(response);
        channel.trigger("client-delete-comment", response);
      },
      error: function (xhr, status, error) {
        console.error("Error deleting comment:", error);
      },
    });
  }
});
