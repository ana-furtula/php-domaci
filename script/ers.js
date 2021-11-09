$('#addForm').submit(function() {
    event.preventDefault();
    const $form = $(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalized = $form.serialize();
    console.log(serijalized);

    $input.prop('disabled', true);

    request = $.ajax({
        url: 'handler/examRegistration/add.php',
        type: 'post',
        data: serijalized
    });

    request.done(function(response, textStatus, jqXHR) {
        if (response == "Success") {
            alert("Exam registration added successfully");
        } else {
            if (response == "Failed") {
                alert("Exam registration cannot be added");
            } else {
                if (response == "Exists") {
                    alert("Exam registration with positive grade for this student and this subject already exists.");
                } else {
                    alert("Grade input incorect.");
                }
            }
        }
        location.reload(true);
    });

})

function deleteLecturer($button) {
    event.preventDefault();

    const fired_btn_value = $button.value;
    request = $.ajax({
        url: 'handler/examRegistration/delete.php',
        type: 'post',
        data: { 'ID': fired_btn_value }
    });

    request.done(function(response, textStatus, jqXHR) {
        if (response == "Success") {
            alert('Exam registration deleted');
            location.reload(true);
        } else {
            alert('Exam registration cannot be deleted');
            location.reload(true);
        }
    });
}

function filterTable($button) {
    var select = document.getElementById('subjectss');
    var value = select.options[select.selectedIndex].value;



    table = document.getElementById("tbody");
    tr = table.getElementsByTagName("tr");

    if (value == "all") {
        for (i = 0; i < tr.length; i++) {
            tr[i].style.display = "";
        }
    } else {
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td.id == value) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}


//sort by subject name
function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("ers-table");
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