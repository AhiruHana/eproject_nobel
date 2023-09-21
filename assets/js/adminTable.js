
$(document).ready(function () {
    // longPolling();
    var listUseCkEditor = ["career", "selected_works", "related_books", "awards_and_honors", "references"];
    var imgListInitialized = false;

    var td_password = document.getElementById("td-password");
    var password = document.getElementById("password");
    var username = document.getElementById("username");
    var current_url = window.location.href;
    
    view_link();
    Delete();

    $('.update').off('click').on('click', function () {
        
        if (current_url.includes("adminTable.php?tableName=users")) {
            td_password.innerText = "New Password";
            password.removeAttribute("required");
            // username.removeAttribute("required");
            username.setAttribute("disabled", "")
        }

        // Thu thập thông tin cần thiết
        var objValue = {};

        for (i = 0; i < fields.length; i++) {
            var fieldsName = fields[i];
            objValue[fieldsName] = $(this).attr('data-' + fieldsName);
            // console.log(objValue[fieldsName])
            // console.log(fieldsName)

            // Kiểm tra nếu fieldsName là "avatar"
            if (fieldsName === "avatar") {
                if (objValue[fieldsName] != "") {
                    var html = "";
                    html +=
                        '<img id="preview-avatar" src="">' +
                        '<div id="delete-icon">&times;</div>';
                    $('#avatar-preview').html("").append(html);
                    $('#preview-avatar').attr('src', objValue[fieldsName]);
                    addAvatar_img('avatar-preview', 'avatar-input', 'preview-avatar');
                } else {
                    $('#avatar-preview').html("");
                    $('#avatar-input').val("");
                    addAvatar_img('avatar-preview', 'avatar-input', 'preview-avatar');
                }
            }
            else if (fieldsName === "img") {
                if (objValue[fieldsName] != "") {
                    var html = "";
                    html +=
                        '<img id="preview-img" src="">' +
                        '<div id="delete-icon">&times;</div>';
                    $('#img-preview').html("").append(html);
                    $('#preview-img').attr('src', objValue[fieldsName]);
                    addAvatar_img('img-preview', 'img-input', 'preview-img');
                    
                } else {
                    $('#img-preview').html("");
                    $('#img-input').val("");
                    addAvatar_img('img-preview', 'img-input', 'preview-img');
                }
            }
            else if (fieldsName === "img_list" && objValue[fieldsName] != "") {
                //tách chuỗi
                if (objValue[fieldsName] != "") {
                    var arr = objValue[fieldsName].split(',');
                    var html = "";
                    arr.forEach(function (element, index) {
                        html +=
                            '<div class="image-preview">' +
                            '  <img class="preview-image" src="' + element + '">' +
                            '  <div class="delete-icon">&times;</div>' +
                            '</div>';
                    });
                    $('#image-preview-container').html("").append(html);

                    //kiểm tra addImgList() được gọi chưa
                    if (!imgListInitialized) {
                        addImgList();
                        imgListInitialized = true;
                    }
                } else {
                    $('#image-preview-container').empty();
                    $('#image-list-input').val("");

                    //kiểm tra addImgList() được gọi chưa
                    if (!imgListInitialized) {
                        addImgList();
                        imgListInitialized = true;
                    }
                }

            }

            else {
                $('#' + fieldsName).val(objValue[fieldsName]);
                var editor = CKEDITOR.instances[fieldsName];
                if (editor) {
                    var content = editor.getData();
                    if (content.trim() == "") {
                        changeCk(fieldsName, listUseCkEditor, (elementId, value) => {
                            var ckeditor = CKEDITOR.replace(elementId);
                            ckeditor.setData(value);
                        })
                    }
                } else {
                    changeCk(fieldsName, listUseCkEditor, (elementId, value) => {
                        var ckeditor = CKEDITOR.replace(elementId);
                        ckeditor.setData(value);
                    })
                }
            }
        }
    });

    $('#create').off('click').on('click', function () {
        if (current_url.includes("adminTable.php?tableName=users")) {
            username.setAttribute("required", "");
        }
        
        // Thu thap thong tin can thiet;
        for (i = 0; i < fields.length; i++) {
            fieldsName = fields[i]
            element = document.getElementById(fieldsName);
            // console.log(element)
            if (fieldsName === "avatar") {
                $('#avatar-preview').html("");
                $('#avatar-input').val("");
                addAvatar_img('avatar-preview', 'avatar-input', 'preview-avatar');
            }
            else if (fieldsName === "img") {
                $('#img-preview').html("");
                $('#img-input').val("");
                addAvatar_img('img-preview', 'img-input', 'preview-img');
            }
            else if (fieldsName === "img_list") {
                $('#image-preview-container').empty();
                $('#image-list-input').val("");

                //kiểm tra addImgList() được gọi chưa
                if (!imgListInitialized) {
                    addImgList();
                    imgListInitialized = true;
                }
            }
            else if (element.tagName.toLowerCase() === "select") {
                var option = element.options[0];
                option.selected = true;
                // console.log(element);
            }
            else {
                $('#' + fieldsName).val("");
                //kiểm tra input có ckeditor hay chưa
                var editor = CKEDITOR.instances[fieldsName];
                if (editor) {
                    editor.setData("");
                } else {
                    changeCk(fieldsName, listUseCkEditor, (elementId) => {
                        var ckeditor = CKEDITOR.replace(elementId);
                        ckeditor.setData("");
                    })
                }
            }
        }

    });

})

function view_link() {
    $('.view-link').off('click').on('click', function () {
        //lấy dữ liệu và chèn vào modal
        var objValue = {};
        for (i = 0; i < fields.length; i++) {
            var fieldsName = fields[i];
            objValue[fieldsName] = $(this).attr('data-' + fieldsName);
            $('#' + fieldsName).val(objValue[fieldsName]);
            // console.log(objValue[fieldsName])
        }

        var id = $(this).data('id');

        $.ajax({
            url: 'adminTable.php?tableName=feedback',
            method: 'POST',
            data: { id: id, status: 1 },
            success: function () {
                console.log('Cập nhật thành công');
            },
            error: function (xhr, status, error) {
                console.log('Lỗi khi cập nhật: ' + error);
            }
        });

        //thông báo số feedback mới
        var unreadCount = parseInt($('#unread-count').text());
        //tìm phân tử anh em của view-link bằng siblings
        var statusValue = $(this).siblings('.status-span').attr("value");
        var statusSpan = $(this).siblings('.status-span');

        if (statusValue === 'true') {
            statusSpan.html(' &nbsp');
            $('#unread-count').text(unreadCount - 1);
        }

    });
}

function Delete() {
    $('.delete').off('click').on('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                var current_url = window.location.href;
                var new_url = current_url.replace('#', '') + "&id=" + id;
                window.location.href = new_url;
                return true;
            }
        })
    });
}

//hiển thị ảnh
function addAvatar_img(element, input, imgTag) {
    const avatarPreview = document.getElementById(element);
    const avatarInput = document.getElementById(input);
    avatarInput.addEventListener('change', function (event) {
        const file = event.target.files[0];

        // Kiểm tra có tệp tin ảnh được chọn
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function () {
                const previewAvatar = document.createElement('img');
                previewAvatar.id = imgTag;
                previewAvatar.src = reader.result;

                const deleteIcon = document.createElement('div');
                deleteIcon.id = 'delete-icon';
                deleteIcon.innerHTML = '&times;';

                avatarPreview.innerHTML = '';  // Xóa bỏ nội dung hiện tại của hình xem trước

                avatarPreview.appendChild(previewAvatar);
                avatarPreview.appendChild(deleteIcon);

                // Hiển thị ảnh và icon xóa
                avatarPreview.style.display = 'inline-block';
                deleteIcon.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    });
    avatarPreview.addEventListener('click', function (event) {
        if (event.target.id === 'delete-icon') {
            avatarPreview.innerHTML = '';  // Xóa bỏ nội dung của hình xem trước

            // Xóa giá trị ô input
            avatarInput.value = '';

            // Ẩn hình xem trước và icon xóa
            avatarPreview.style.display = 'none';
        }
    });

}

//thêm imglist 

function addImgList() {
    const previewContainer = document.getElementById('image-preview-container');
    const imageListInput = document.getElementById('image-list-input');
    imageListInput.addEventListener('change', function (event) {
        const files = event.target.files;

        // Lặp qua từng tệp tin ảnh được chọn
        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            // Kiểm tra có tệp tin ảnh được chọn
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function () {
                    const previewImage = document.createElement('img');
                    previewImage.className = 'preview-image';
                    previewImage.src = reader.result;

                    const deleteIcon = document.createElement('div');
                    deleteIcon.className = 'delete-icon';
                    deleteIcon.innerHTML = '&times;';

                    const imagePreview = document.createElement('div');
                    imagePreview.className = 'image-preview';
                    imagePreview.appendChild(previewImage);
                    imagePreview.appendChild(deleteIcon);

                    previewContainer.appendChild(imagePreview);
                };

                reader.readAsDataURL(file);
            }
        }
    });

    // Xóa ảnh và reset giá trị ô input khi click vào icon xóa
    previewContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-icon')) {
            const imagePreview = event.target.parentNode;
            const imageContainer = imagePreview.parentNode;
            const fileInput = imageContainer.parentNode.querySelector('input[type="file"]');

            imageContainer.removeChild(imagePreview);

            // Reset giá trị ô input nếu không còn ảnh nào
            if (imageContainer.children.length === 0) {
                fileInput.value = '';
            }
        }
    });
}

//thay đổi ckeditor
function changeCk(elementId, listUseCkEditor, callback) {
    var $this = $(`#${elementId}`);
    var changeToTextarea = `<textarea id="${elementId}" name="${elementId}"></textarea>`
    var $td = $this.parent();
    var value = $this.val();
    if (listUseCkEditor.includes(elementId)) {
        // Kiểm tra nếu CKEditor đã tồn tại
        if (CKEDITOR.instances[elementId]) {
            var editor = CKEDITOR.instances[elementId];
            var content = editor.getData();
            // Kiểm tra nếu CKEditor không chứa dữ liệu
            if (content.trim() === "") {
                editor.setData(value);
            }
        } else {
            $this.remove();
            $td.append(changeToTextarea);
            if (typeof callback === "function") {
                callback(elementId, value);
            }
        }
    }
}

//lấy dữ liệu sever gửi tới
var eventSource = new EventSource('./SSE.php');
eventSource.addEventListener('feedbackUpdate', function (event) {
    var data = JSON.parse(event.data);
    var numOfNewFeedback = data.numOfNewFeedback;
    var newFeedback = data.newFeedback;

    updateFeedbackCount(numOfNewFeedback, newFeedback);
    //đăng kí lại sự kiện click
    view_link()
    Delete()
});

function updateFeedbackCount(numOfNewFeedback, newFeedback) {
    var unreadCountElement = document.getElementById('unread-count');
    var current_url = window.location.href

    //cập nhật số lượng feedback khi có feedback mới
    if (numOfNewFeedback > 0) {
        unreadCountElement.textContent = numOfNewFeedback;
    }

    //cập nhật feedback mới nếu đang ở bảng feedback 
    if (current_url.includes("adminTable.php?tableName=feedback")) {
        var table = document.querySelector('table#datatablesSimple')
        var tbody = table.querySelector('tbody')
        var firstTr = tbody.querySelector('tr:first-child')
        var tdList = firstTr.getElementsByTagName("td");
        var sencondTd = tdList[1];
        var dataId = sencondTd.textContent;

        if (dataId < newFeedback.id) {
            var trList = tbody.getElementsByTagName("tr");

            for (var i = 0; i < trList.length; i++) {
                var tr = trList[i];
                tr.setAttribute('data-index', i + 1);
            }

            // thêm feedback mới
            var newRow = tbody.insertRow(0);
            newRow.innerHTML = firstTr.innerHTML;
            newRow.setAttribute("data-index", 0);

            var statusValue = newRow.getElementsByClassName("status-span");
            statusValue[0].setAttribute("value", "true");
            statusValue[0].textContent = "!";

            // var fields = ["id", "name", "email", "message", "sending_time", "status"];
            var view_link = newRow.getElementsByClassName("view-link");

            for (var i = 0; i < fields.length; i++) {
                view_link[0].setAttribute("data-" + fields[i], newFeedback[fields[i]]);
            }

            var delete_id = newRow.getElementsByClassName("delete");
            delete_id[0].setAttribute("data-id", newFeedback.id);

            var tdList = newRow.getElementsByTagName("td");
            for (var i = 0; i < fields.length - 1; i++) {
                tdList[i + 1].textContent = newFeedback[fields[i]];
            }
            // console.log(newRow)
        }
    }
}