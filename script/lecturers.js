function deleteLecturer($button) {
    event.preventDefault();

    const fired_btn_value = $button.value;
    request = $.ajax({
        url: 'handler/lecturer/delete.php',
        type: 'post',
        data: { 'ID': fired_btn_value }
    });

    request.done(function(response, textStatus, jqXHR) {
        if (response == "Success") {
            alert('Lecturer deleted');
            location.reload(true);
        } else {
            alert('Lecturer cannot be deleted');
        }
    });
}

$("#updateForm").submit(function() {

    event.preventDefault();
    const $form = $(this);
    const serijalized = $form.serialize();
    console.log(serijalized);
    const data = serijalized;
    request = $.ajax({
        url: 'handler/lecturer/update.php',
        type: 'post',
        data: data
    });

    request.done(function(response, textStatus, jqXHR) {
        if (response == "Success") {
            alert("Lecturer updated successfully");
            location.reload(true);
        } else {
            alert("Lecturer cannot be updated.");
        }
    });

})