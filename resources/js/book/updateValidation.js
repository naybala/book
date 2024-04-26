import { errorValidation } from "../errorValidation";
let validationList = [
    {
        selector: "#book_unique_idx",
        checkValue: "",
        errorMsg: "Please fill book unique idx!",
    },
    {
        selector: "#book_name",
        checkValue: "",
        errorMsg: "Please fill book name!",
    },
    {
        selector: "#co_id",
        checkValue: "",
        errorMsg: "Please fill content owner!",
    },
    {
        selector: "#publisher_id",
        checkValue: "",
        errorMsg: "Please fill publisher!",
    },
];
$("#btn-submit").on("click", function (e) {
    errorValidation(
        validationList,
        "#createBookForm",
        "#validateCreateBook",
        e
    );
});
