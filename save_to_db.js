$(document).ready(function(){
    $('.btn_save').click(function(){
        $.ajax({
            url: 'luudb.php', // Đường dẫn đến tệp PHP bạn muốn gọi
            type: 'POST', // Hoặc 'GET' tùy thuộc vào cách bạn đã cấu hình tệp PHP của mình
            success: function(response){
                // Xử lý phản hồi từ tệp PHP ở đây nếu cần
                console.log(response);
            },
            error: function(xhr, status, error){
                // Xử lý lỗi nếu có
                console.error(xhr.responseText);
            }
        });
    });
});