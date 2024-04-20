<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User edit</title>
</head>
<body>
    <div align="center">
        <p>please welcome to view pages.</p>
        
        <form id="updateForm">
            <input type="hidden" name="id" id="id" value="<?php echo $index['id'];?>">
            Name:<input type="text" id="name" name="user_name" value="<?php echo $index['name'];?>"><br/><br/>
            Email:<input type="text" id="email" name="user_email" value="<?php echo $index['email'];?>"><br/><br/>
            Age:<input type="number" id="age" name="user_age" value="<?php echo $index['age'];?>"> <br/><br/>
            <input type="submit" value="Save">
        </form><br/>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#updateForm').submit(function(event){
                event.preventDefault();
                var id = $('#id').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var age = $('#age').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('user/update'); ?>',
                    // data: formData,
                    // dataType: 'json',
                    data: { id: id, name: name, email: email, age: age },
                    success: function(response){
                        alert(response.message);
                        window.location.href = '<?php echo base_url('user/index'); ?>';
                        
                        // Handle success response here
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                        // Handle error response here
                    }
                });
            });
        });
    </script>
</body>
</html>
