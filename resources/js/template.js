function ajax(fn, modulo, post) {
    $("a.btn").addClass("disabled");
    $.post("index.php?ajax=" + modulo,
        {
            fn: fn,
            form: $("#frmSistema").serialize(),
            post: post
        },
        function (result) {
            $("a.btn").removeClass("disabled");
            if (typeof result === 'string') {
                alert(result);
                console.error(result);
            }
            else
                window[fn](result);
        },
        'json'
    ).fail(function (result) {
            $("a.btn").removeClass("disabled");
            alert(result.responseText);
            console.error(result.responseText);
        }
    );
}