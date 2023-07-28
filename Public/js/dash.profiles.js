const url = document.querySelector("tbody").getAttribute("data-url-info");
const showProfileBtn = document.querySelectorAll(".show-profile-btn");
const showProfileForm = document.querySelector("#show-profile-form");


const imgElement = document.querySelector("#show-profile-item-img");
const avatarField = document.querySelector("#show-profile-img-path");
const nickField = document.querySelector("#show-profile-nick");
const nameField = document.querySelector("#show-profile-name");
const lastnameField = document.querySelector("#show-profile-lastname");
const emailField = document.querySelector("#show-profile-email");
const addressField = document.querySelector("#show-profile-address");
const phoneField = document.querySelector("#show-profile-phone");
const idField = document.querySelector("#show-profile-id");

showProfileBtn.forEach(spb => {
    spb.addEventListener("click", async (e) => {
        e.preventDefault();
        e.stopPropagation();

        const userID = spb.parentElement.parentElement.getAttribute("data-user-id");
        const newUrl = url.replace(":id", userID);

        let response = await fetch(newUrl, {
            method: "post",
        });

        if (response.status != 200) {
            resetShowProfileForm();
            return notify({
                text: response.statusText,
                status: "error",
                bg: "bg-danger"
            });
        }

        const result = await response.json();

        imgElement.setAttribute("src", `${imgElement.getAttribute("data-url-base")}${result.user.user_img_path}`);
        avatarField.value = "Avatar 1";
        nickField.value = result.user.user_nick ?? "";
        nameField.value = result.user.user_name ?? "";
        lastnameField.value = result.user.user_lastname ?? "";
        emailField.value = result.user.user_email ?? "";
        addressField.value = result.user.user_address ?? "";
        phoneField.value = result.user.user_phone ?? "";
        idField.value = result.user.user_id ?? "";

        document.querySelector("#show-profile").classList.add("show");

        return notify({
            text: response.status.message,
            status: "success",
            bg: "bg-success"
        });




        // $.post(newUrl)
        //     .done((response) => {
        //         response = JSON.parse(response);
        //         if (response.status.code != 200) {
        //             resetShowProfileForm();
        //             return notify({
        //                 text: response.status.message,
        //                 status: "error",
        //                 bg: "bg-danger"
        //             });
        //         }

        //         imgElement.setAttribute("src", `${imgElement.getAttribute("data-url-base")}${response.user.user_img_path}`);
        //         avatarField.value = "Avatar 1";
        //         nickField.value = response.user.user_nick ?? "";
        //         nameField.value = response.user.user_name ?? "";
        //         lastnameField.value = response.user.user_lastname ?? "";
        //         emailField.value = response.user.user_email ?? "";
        //         addressField.value = response.user.user_address ?? "";
        //         phoneField.value = response.user.user_phone ?? "";
        //         idField.value = response.user.user_id ?? "";

        //         return notify({
        //             text: response.status.message,
        //             status: "success",
        //             bg: "bg-success"
        //         });
        //     });
    });
})

showProfileForm.addEventListener("submit", (e) => {
    e.preventDefault();
    e.stopPropagation();

    console.log(addressField.getAttribute("value"));

    $.post(showProfileForm.getAttribute("action"), {
        id: idField.value,
        nick: nickField.value,
        name: nameField.value,
        lastname: lastnameField.value,
        email: emailField.value,
        address: addressField.value,
        phone: phoneField.value,
    }).done((response) => {
        response = JSON.parse(response);
        if (response.status.code != 200) {
            return notify({
                text: response.status.message,
                status: "error",
                bg: "bg-danger"
            });
        }

        const tableUserRow = document.querySelector(`[data-user-id="${idField.value}"]`);
        tableUserRow.querySelector(".user-name").innerHTML = `${nameField.value} ${lastnameField.value}`

        resetShowProfileForm();
        return notify({
            text: response.status.message,
            status: "success",
            bg: "bg-success"
        });
    });

})

const resetShowProfileForm = () => {
    const closeBtn = showProfileForm.querySelector(`[data-bs-dismiss="modal"]`);
    showProfileForm.reset();
    closeBtn.click();
}