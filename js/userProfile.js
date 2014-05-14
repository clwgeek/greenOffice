
$(function() {
    $("#new").click(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var pass = $("#pass").val();
        var department = $("#department").val();
        var officeNumber = $("#officeNumber").val();
        var lastName = $("#lastName").val();
        var firstName = $("#firstName").val();
        var sharedOffice = $("#sharedOffice").val();
        var deskLocation = $("#deskLocation").val();
        var campus = $("#campus").val();
        var button = $("#new").val();
        $.post("dbFunctions/userData.php",
                {
                    email: email,
                    pass: pass,
                    department: department,
                    officeNumber: officeNumber,
                    lastName: lastName,
                    firstName: firstName,
                    sharedOffice: sharedOffice,
                    deskLocation: deskLocation,
                    campus: campus,
                    button: button
                },
        function(data, status) {
            alert(data);

        });
    });

});

$(function() {
    $("#update").click(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var pass = $("#pass").val();
        var department = $("#department").val();
        var officeNumber = $("#officeNumber").val();
        var lastName = $("#lastName").val();
        var firstName = $("#firstName").val();
        var sharedOffice = $("#sharedOffice").val();
        var deskLocation = $("#deskLocation").val();
        var campus = $("#campus").val();
        var button = $("#update").val();
        $.post("dbFunctions/userData.php",
                {
                    email: email,
                    pass: pass,
                    department: department,
                    officeNumber: officeNumber,
                    lastName: lastName,
                    firstName: firstName,
                    sharedOffice: sharedOffice,
                    deskLocation: deskLocation,
                    campus: campus,
                    button: button
                },
        function(data, status) {
            alert(data);

        });
    });

});

$(function() {
    $("#login").click(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var pass = $("#pass").val();
        var op = $("#op").val();
        var button = $("#login").val();
        $.post("dbFunctions/userData.php",
                {
                    email: email,
                    pass: pass,
                    op: op,
                    button: button
                },
        function(data, status) {
            alert(data);

        });
    });

});

$(function() {
    $("#change").click(function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var pass = $("#pass").val();
        var newpass = $("newpass").val;
        var newpass2 = $("newpass2").val;
        var op = $("#op2").val();
        var button = $("#change").val();
        $.post("dbFunctions/userData.php",
                {
                    email: email,
                    pass: pass,
                    op: op,
                    button: button,
                    newpass: newpass,
                    newpass2: newpass2
                },
        function(data, status) {
            alert(data);
        });
    });
});

$(function() {
    $("#forgot").click(function(e) {
        e.preventDefault();
        var email = $("#email3").val();
        var op = $("#op3").val();       
       $.post("dbFunctions/userData.php",
                {
                    email: email,
                    op: op                   
                },
        function(data, status) {
        alert(data);
        });
    });
});