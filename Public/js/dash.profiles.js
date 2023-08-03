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

let response, data;



showProfileBtn.forEach(spb => {
    spb.addEventListener("click", async (e) => {
        e.preventDefault();
        e.stopPropagation();

        const userID = spb.parentElement.parentElement.getAttribute("data-user-id");
        const newUrl = url.replace(":id", userID);

        response = await fetch(newUrl, {
            method: "GET",
        });

        if (await checkFetchError(response)) return;

        data = await response.json();

        imgElement.setAttribute("src", `${imgElement.getAttribute("data-url-base")}${data.user.user_img_path}`);
        avatarField.value = "Avatar 1";
        nickField.value = data.user.user_nick ?? "";
        nameField.value = data.user.user_name ?? "";
        lastnameField.value = data.user.user_lastname ?? "";
        emailField.value = data.user.user_email ?? "";
        addressField.value = data.user.user_address ?? "";
        phoneField.value = data.user.user_phone ?? "";
        idField.value = data.user.user_id ?? "";

        $("#show-profile").modal("show")

        return notify({
            text: data.message,
            status: "success",
            bg: "bg-success"
        });
    });
})

showProfileForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    e.stopPropagation();

    const url = showProfileForm.getAttribute("action");
    response = await fetch(url, {
        method: "POST",
        body: JSON.stringify({
            id: idField.value,
            nick: nickField.value,
            name: nameField.value,
            lastname: lastnameField.value,
            email: emailField.value,
            address: addressField.value,
            phone: phoneField.value,
        }),
    })

    if (response.status != 200) {
        return notify({
            text: response.statusText,
            status: "error",
            bg: "bg-danger"
        });
    }

    const tableUserRow = document.querySelector(`[data-user-id="${idField.value}"]`);
    tableUserRow.querySelector(".user-name").innerHTML = `${nameField.value} ${lastnameField.value}`

    resetShowProfileForm();
    return notify({
        text: await response.text(),
        status: "success",
        bg: "bg-success"
    });
})

const resetShowProfileForm = () => {
    const closeBtn = showProfileForm.querySelector(`[data-bs-dismiss="modal"]`);
    showProfileForm.reset();
    closeBtn.click();
}