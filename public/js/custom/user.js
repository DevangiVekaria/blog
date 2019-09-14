var User = function () {

    //Change the user role as per the selected from dropdown
    var roleChange = function () {
        $("select").on('change', function () {
            var roleId = $(this).val();
            var userId = $(this).attr('id').replace('userRole', '');
            var currentVal = $(this).attr('data-value');
            var dropDown = $(this);
            swal({
                title: "Are you sure?",
                text: "You want to change the role for this user ?",
                icon: "warning",
                buttons: {
                    cancel: 'Cancel',
                    confirm: 'Yes, Change It'
                },
                dangerMode: true
            }).then((isConfirm) => {
                    if (isConfirm) {
                        $.ajax({
                            type: "PUT",
                            url: updateRole,
                            data: {
                                userId: userId,
                                roleId: roleId,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.message === 'success') {
                                    swal("Completed!", "User role changed successfully!", "success");
                                    dropDown.attr('data-value', roleId);
                                } else {
                                    swal("Error!", "Something went wrong!", "error");
                                    dropDown.val(currentVal);
                                }
                            },
                            error: function () {
                                swal("Error!", "Something went wrong!", "error");
                            }
                        });
                    } else {
                        dropDown.val(currentVal);
                    }

                }
            );
        });
    };

    var deleteUser = function (usersUrl) {
        $('.deleteBtn').on('click', function () {
            let userId = $(this).attr('id').replace('user', '');
            swal({
                title: "Are you sure?",
                text: "All Posts from this user will be deleted. You want to delete this user ?",
                icon: "warning",
                buttons: {
                    cancel: 'Cancel',
                    confirm: 'Yes, Delete'
                },
                dangerMode: true
            }).then((isConfirm) => {
                    if (isConfirm) {
                        window.location.href = usersUrl + '/' + userId + '/delete';
                    }
                }
            );
        });
    };

    return {
        manage: function () {
            roleChange();
            deleteUser(usersUrl);
        }
    }

}();


