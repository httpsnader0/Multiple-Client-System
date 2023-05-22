// JAVASCRIPT
(function ($) {
    "use strict";

    // UNSIGNED INPUT NUMBER
    $(document).on("keydown", 'input[class="unsigned"]', function (evt) {
        if (
            evt.which == 109 ||
            evt.which == 107 ||
            evt.which == 110 ||
            evt.which == 190 ||
            evt.which == 189
        ) {
            return false;
        }
    });

    // INPUT NUMBER
    $(document).on("keypress", ".onlyNumber", function (evt) {
        var charCode = evt.which ? evt.which : evt.keyCode;
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    });

    // INPUTS VALIDATION
    if ($("input").length || $("textarea").length) {
        $(document).on("input change", "input, textarea", function () {
            $(this).removeClass("is-invalid");
            $(this).parent().find(".invalid-feedback").remove();
            $(this).parent().parent().find(".invalid-feedback").remove();
            if ($("tags").length) {
                $(this).parent().children("tags").removeClass("is-invalid");
            }
            if (this.type == "number") {
                $(this).parent().parent().find(".invalid-feedback").remove();
            } else if (this.type == "password") {
                $(this)
                    .closest("[data-kt-password-meter='true']")
                    .find(".invalid-feedback")
                    .remove();
                $(this).closest("div").find(".btn-show").removeClass("me-5");
            } else if (this.type == "file") {
                $(this).closest("label").removeClass("border-danger");
                $(this)
                    .closest(".image-input")
                    .find(".image-input-wrapper")
                    .removeClass("border-danger");
                $(this)
                    .closest(".image-input")
                    .find(".invalid-feedback")
                    .remove();
            } else if (this.type == "radio") {
                $(this)
                    .parent()
                    .parent()
                    .find("label")
                    .removeClass("border-danger");
                $(this)
                    .parent()
                    .parent()
                    .parent()
                    .find(".invalid-feedback")
                    .remove();
            }
        });
        $(document).on("click", "input", function () {
            $(this).select();
        });
    }
    if ($("select").length) {
        $(document).on("change", "select", function () {
            $(this).removeClass("is-invalid");
            $(this)
                .closest("div")
                .find(".select2-selection")
                .removeClass("is-invalid");
            $(this).closest("div").find(".invalid-feedback").remove();
        });
    }

    // SUBMIT
    $("form").on("submit", function (e) {
        if (!$(this).find("button[type='submit']").hasClass("notIndicator")) {
            $(this)
                .find("button[type='submit']")
                .attr("data-kt-indicator", "on");
            $(this).find("button[type='submit']").attr("disabled", true);
        }
    });
})(jQuery);
