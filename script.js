let captchaCode = "";

function generateCaptcha() {

    const characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    captchaCode = "";

    for (let i = 0; i < 6; i++) {

        captchaCode += characters.charAt(
            Math.floor(Math.random() * characters.length)
        );

    }

    document.getElementById("captcha").innerText = captchaCode;
}

function validateForm() {

    let userCaptcha =
        document.getElementById("captchaInput").value;

    if (userCaptcha !== captchaCode) {

        alert("Incorrect Captcha!");

        generateCaptcha();

        return false;
    }

    if (!document.getElementById("terms").checked) {

        alert("Please accept Terms and Conditions.");

        return false;
    }

    return true;
}

window.onload = generateCaptcha;