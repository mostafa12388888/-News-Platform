import "./bootstrap";
if (role == "user") {
    window.Echo.private("App.Models.User." + id).notification(
        (notification) => {
            $("#count-notification").text(+$("#count-notification").text() + 1);
            $("#push-notification").prepend(`
            <div class="dropdown-item d-flex justify-content-between align-items-center">
                                     <span>Post comment :${notification.post_title.substring(
                                         0,
                                         4
                                     )}....</span>
                                     <a href="${notification.link}?notify=${
                notification.id
            }">
                                         <i class="fa fa-eye"></i>
                                     </a>
                                     <form action="" method="POST">
                                         <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                     </form>
                                 </div>
            `);
        }
    );
}
// Admin
if (role == "admin") {
    window.Echo.private("App.Models.Admin." + adminId).notification(
        (notification) => {
            $("#admin_notify_count").text(+$("#admin_notify_count").text() + 1);
            $("#admin_notify_push").prepend(`
      <a class="dropdown-item d-flex align-items-center" href="${notification.link}?notify-admin=${notification.id}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">${notification.created_at}</div>
                                <span class="font-weight-bold">${notification.contact_title}</span>
                            </div>
                        </a>
                `);
        }
    );
}
