<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
</head>
<style>
    table, th, td, th {
       border-collapse: collapse;
       border: 1px solid black;
       padding: 10px;
    }
</style>
<body>
    <div align="center">
        <p>Please welcome to view pages.</p>
        <!-- <i>event.preventDefault()</i> -->
        <form id="user-form"  method="post">
            <!-- <input type="hidden" id="edit-id" name="id"> -->
            Name:<input type="text" id="name" name="user_name"><br/><br/>
            Email:<input type="text" id="email" name="user_email"><br/><br/>
            Age:<input type="number" id="age" name="user_age" > <br/><br/>
            <button type="submit" id="submit">Submit</button>
        </form><br/>

        <table id="user-table">
           <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Action</th>
           </tr>
           <?php foreach($userlist as $user): ?>
                <tr id="row_<?php echo $user->id; ?>">
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->age; ?></td>
                    <td>
                    <a href="<?php echo base_url(); ?>user/view/<?php echo $user->id; ?>">Edit</a>&nbsp;
                        <a href="#" class="delete" data-id="<?php echo $user->id; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#user-form').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var id = $('#edit-id').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var age = $('#age').val();

        $.ajax({
            // url:'<?php echo base_url("user/insert"); ?>',
            url:'<?= base_url().'index.php/user/insert';?>',
            method: 'POST',
            dataType: 'json',
            data: { id: id, name: name, email: email, age: age },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    // Refresh the table
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    
    // Delete user
    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url("user/delete"); ?>/' + id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#row_' + id).remove(); // Remove row from table after successful delete
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>


<!-- new update -->
<!-- <script>
    $('#user-form').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var id = $('#edit-id').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var age = $('#age').val();

        // Simulate success response
        var response = {
            success: true,
            message: 'User inserted successfully!'
        };
        handleResponse(response);
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        
        // Simulate success response
        var response = {
            success: true,
            message: 'User deleted successfully!'
        };
        handleResponse(response);
    });

    function handleResponse(response) {
        if (response.success) {
            alert(response.message);
            // Refresh the table
            location.reload();
        } else {
            alert(response.message);
        }
    }
</script> -->

</html>
