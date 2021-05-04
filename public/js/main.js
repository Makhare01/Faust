function myTrim(x) {
    return x.replace(/^\s+|\s+$/gm, "");
}

function Clear() {
    document.getElementById("choosenAccount").value = "";
    document.getElementById("account_id").value = null;
    document.getElementById("choosenOffer").value = "";
    document.getElementById("offer_id").value = null;
}

function addAccount(id) {
    var account = document.getElementById("account" + id).textContent;
    document.getElementById("choosenAccount").value = myTrim(account);
    var accountId = document.getElementById("accountId" + id).textContent;
    document.getElementById("account_id").value = parseInt(accountId);
}

function addOffer(id) {
    var offer = document.getElementById("offer" + id).textContent;
    document.getElementById("choosenOffer").value = offer;
    var offerId = document.getElementById("offerId" + id).textContent;
    document.getElementById("offer_id").value = parseInt(offerId);
}

// Proxy SSH radio burrons

function proxy() {
    let proxy = document.getElementById("proxy");

    let ssh_ip = document.getElementById("ssh_ip");
    let ssh_port = document.getElementById("ssh_port");
    let ssh_login = document.getElementById("ssh_login");
    let ssh_pwd = document.getElementById("ssh_pwd");

    if (proxy.checked == true) {
        ssh_ip.disabled = true;
        ssh_ip.value = null;

        ssh_port.disabled = true;
        ssh_port.value = null;

        ssh_login.disabled = true;
        ssh_login.value = null;

        ssh_pwd.disabled = true;
        ssh_pwd.value = null;
    }
}

function ssh() {
    let ssh = document.getElementById("ssh");

    let ssh_ip = document.getElementById("ssh_ip");
    let ssh_port = document.getElementById("ssh_port");
    let ssh_login = document.getElementById("ssh_login");
    let ssh_pwd = document.getElementById("ssh_pwd");

    if (ssh.checked == true) {
        ssh_ip.disabled = false;

        ssh_port.disabled = false;

        ssh_login.disabled = false;

        ssh_pwd.disabled = false;
    }
}

// Account modal

function modalAccount(id) {
    var modal = document.getElementById("myModalAc" + id);
    modal.style.display = "block";
}

function closeAccountModal(id) {
    var modal = document.getElementById("myModalAc" + id);
    modal.style.display = "none";
}

function closeModal(id) {
    var modal = document.getElementById("myModalAc" + id);
    modal.style.display = "none";
}

// function enableStateEdit(id) {
//     var disable = document.getElementById("state" + id);
//     disable.style.pointerEvents = "all";
//     disable.style.background = "#FFFFFF";
// }

function enableStateFunc() {
    var selectBox = document.getElementById("country_code");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var disable = document.getElementById("state");

    if (selectedValue == "United States of America") {
        disable.style.pointerEvents = "all";
        disable.style.background = "#FFFFFF";
    } else {
        disable.style.pointerEvents = "none";
        disable.style.background = "#EFF1F3";
        disable.value = "N/A";
    }
}

function enableEditStateFunc(id) {
    var selectBox = document.getElementById("edit_country_code" + id);
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var disable = document.getElementById("state" + id);
    var selected = document.getElementById("selected" + id);

    if (selectedValue == "United States of America") {
        selected.value = "N/A";
        selected.textContent = "N/A";
        disable.style.pointerEvents = "all";
        disable.style.background = "#FFFFFF";
    } else {
        selected.value = "N/A";
        selected.textContent = "N/A";
        disable.value = "N/A";
        disable.style.pointerEvents = "none";
        disable.style.background = "#EFF1F3";
    }
}

// Delete modal
function modalDelete(id) {
    var modal = document.getElementById("myModalDelete" + id);
    modal.style.display = "block";
}

function closeDeleteModalX(id) {
    var modal = document.getElementById("myModalDelete" + id);
    modal.style.display = "none";
}

function closeDeleteModal(id) {
    var modal = document.getElementById("myModalDelete" + id);
    modal.style.display = "none";
}

// Ready modal
function modalReady(id) {
    var modal = document.getElementById("myModalReady" + id);
    modal.style.display = "block";
}

function closeReadyModalX(id) {
    var modal = document.getElementById("myModalReady" + id);
    modal.style.display = "none";
}

function closeReadyModal(id) {
    var modal = document.getElementById("myModalReady" + id);
    modal.style.display = "none";
}

// Offer modal

function modal(id) {
    var modal = document.getElementById("myModal" + id);
    modal.style.display = "block";
}

function closeModalO(id) {
    var modal = document.getElementById("myModal" + id);
    modal.style.display = "none";
}

function closeM(id) {
    var modal = document.getElementById("myModal" + id);
    modal.style.display = "none";
}

// Roller work modal
function modalCaseWork(id) {
    var modal = document.getElementById("myModalCaseWork" + id);
    modal.style.display = "block";
}

function closeCaseWorkModalX(id) {
    var modal = document.getElementById("myModalCaseWork" + id);
    modal.style.display = "none";
}

function closeCaseWorkModal(id) {
    var modal = document.getElementById("myModalCaseWork" + id);
    modal.style.display = "none";
}

// Roller review modal
function modalReview(id) {
    var modal = document.getElementById("myModalReview" + id);
    modal.style.display = "block";
}

function closeReviewModalX(id) {
    var modal = document.getElementById("myModalReview" + id);
    modal.style.display = "none";
}

function closeReviewModal(id) {
    var modal = document.getElementById("myModalReview" + id);
    modal.style.display = "none";
}

// Roller billing modal
function modalBilling(id) {
    var modal = document.getElementById("myModalBilling" + id);
    modal.style.display = "block";
}

function closeBillingModalX(id) {
    var modal = document.getElementById("myModalBilling" + id);
    modal.style.display = "none";
}

function closeBillingModal(id) {
    var modal = document.getElementById("myModalBilling" + id);
    modal.style.display = "none";
}

// Suspend modal
function modalSuspend(id) {
    var modal = document.getElementById("myModalSuspend" + id);
    modal.style.display = "block";
}

function closeSuspendModalX(id) {
    var modal = document.getElementById("myModalSuspend" + id);
    modal.style.display = "none";
}

function closeSuspendModal(id) {
    var modal = document.getElementById("myModalSuspend" + id);
    modal.style.display = "none";
}

// Superadmin Delete modal
function modalSupDelete(id) {
    var modal = document.getElementById("myModalSupDelete" + id);
    modal.style.display = "block";
}

function closeSupDeleteModalX(id) {
    var modal = document.getElementById("myModalSupDelete" + id);
    modal.style.display = "none";
}

function closeSupDeleteModal(id) {
    var modal = document.getElementById("myModalSupDelete" + id);
    modal.style.display = "none";
}

// Superadmin Work modal
function modalSupWork(id) {
    var modal = document.getElementById("myModalSupWork" + id);
    modal.style.display = "block";
}

function closeSupWorkModalX(id) {
    var modal = document.getElementById("myModalSupWork" + id);
    modal.style.display = "none";
}

function closeSupWorkModal(id) {
    var modal = document.getElementById("myModalSupWork" + id);
    modal.style.display = "none";
}

// Superadmin Valid modal
function modalSupValid(id) {
    var modal = document.getElementById("myModalSupValid" + id);
    modal.style.display = "block";
}

function closeSupValidModalX(id) {
    var modal = document.getElementById("myModalSupValid" + id);
    modal.style.display = "none";
}

function closeSupValidModal(id) {
    var modal = document.getElementById("myModalSupValid" + id);
    modal.style.display = "none";
}

// User Delete modal
function modalUserDelete(id) {
    var modal = document.getElementById("myModalUserDelete" + id);
    modal.style.display = "block";
}

function closeUserDeleteModalX(id) {
    var modal = document.getElementById("myModalUserDelete" + id);
    modal.style.display = "none";
}

function closeUserDeleteModal(id) {
    var modal = document.getElementById("myModalUserDelete" + id);
    modal.style.display = "none";
}

// Checkbox
function checkBox() {
    var checkBox = document.getElementById("account_numbercheck");
    var text = document.getElementById("account_number");
    if (checkBox.checked == true) {
        text.style.pointerEvents = "All";
        text.style.background = "#FFFFFF";
    } else {
        text.style.pointerEvents = "none";
        text.style.background = "#EFF1F3";
    }
}

// Edit Checkbox
function checkBoxEdit(id) {
    var checkBox = document.getElementById(id);
    var text = document.getElementById("account_" + id);
    if (checkBox.checked == true) {
        text.style.pointerEvents = "All";
        text.style.background = "#FFFFFF";
        // text.style.border = "solid 1px red";
    } else {
        text.style.pointerEvents = "none";
        text.style.background = "#EFF1F3";
    }
}
