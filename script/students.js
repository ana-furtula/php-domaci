function deleteStudent() {
    event.preventDefault();

    const checked = $('input[name=checked-donut]:checked');
    request = $.ajax({
        url: 'handler/student/delete.php',
        type: 'post',
        data: { 'ID': checked.val() }
    });

    request.done(function(response, textStatus, jqXHR) {
        if (response == "Success") {
            checked.closest('tr').remove();
            alert('Student deleted');
        } else {
            alert('Student cannot be deleted');
        }
    });

}

$("#updateForm").submit(function() {

    event.preventDefault();

    const checked = $('input[name=checked-donut]:checked');
    if (typeof checked.val() === 'undefined') {
        alert("You must choose a student.")
        return;
    } else {
        const $form = $(this);
        const serijalized = $form.serialize();
        const data = serijalized + "&idBefore=" + checked.val();
        request = $.ajax({
            url: 'handler/student/update.php',
            type: 'post',
            data: data
        });

        request.done(function(response, textStatus, jqXHR) {
            if (response == "Success") {
                alert("Student updated successfully");
                location.reload(true);
            } else {
                alert("Student cannot be updated.");
            }
        });
    }
})

$('#addForm').submit(function() {
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalized = $form.serialize();
    console.log(serijalized);

    $input.prop('disabled', true);

    request = $.ajax({
        url: 'handler/student/add.php',
        type: 'post',
        data: serijalized
    });

    request.done(function(response, textStatus, jqXHR) {
        if (response == "Success") {
            alert("Student added successfully");
            location.reload(true);
        } else {
            alert("Student cannot be added");
        }
    });

})

function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("students-table");
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}