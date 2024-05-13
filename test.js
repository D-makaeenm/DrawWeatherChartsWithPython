$(document).ready(function() {
    $('#test').click(function(){
        fetch('/hello')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert(data.message); // Hiển thị thông báo từ Python
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
