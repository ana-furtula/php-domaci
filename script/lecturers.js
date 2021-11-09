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
            location.reload(true);
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
            if (response == "Failed") {
                alert("Lecturer cannot be updated.");
                location.reload(true);
            } else {
                alert("Input doesnt match required format.");
            }
        }

    });

})

$('#addForm').submit(function() {
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalized = $form.serialize();
    console.log(serijalized);

    request = $.ajax({
        url: 'handler/lecturer/add.php',
        type: 'post',
        data: serijalized
    });

    request.done(function(response, textStatus, jqXHR) {
        if (response == "Success") {
            alert("Lecturer added successfully");
            location.reload(true);
        } else {
            if (response == "Failed") {
                alert("Lecturer cannot be added.");
                location.reload(true);
            } else {
                alert("Input doesnt match required format.");
            }
        }
    });

})