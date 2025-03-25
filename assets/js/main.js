// burger-menu
document.querySelector(".open-menu-js").addEventListener("click", function() {
  var mobileMenuOverlay = document.querySelector(".mobileMenu-overlay");
  mobileMenuOverlay.classList.add("open");
  document.body.style.overflowX = "hidden";
});

document.querySelector(".mobileMenu-close").addEventListener("click", function() {
  var mobileMenuOverlay = document.querySelector(".mobileMenu-overlay");
  mobileMenuOverlay.classList.remove("open");
  document.body.style.overflowX = "auto";
});


// tabs
const tabs = document.querySelectorAll('.tab');
const tabContents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        // Удаление активного класса у всех табов и контента
        tabs.forEach(item => item.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));

        // Добавление активного класса к выбранному табу и соответствующему контенту
        tab.classList.add('active');
        const contentId = tab.getAttribute('data-tab');
        document.getElementById(contentId).classList.add('active');
    });
});


// price switch
document.getElementById('pricing-toggle').addEventListener('change', function() {
  const isChecked = this.checked;
  const prices = document.querySelectorAll('.price');

  prices.forEach(price => {
    const monthlyPrice = price.getAttribute('data-monthly');
    const yearlyPrice = price.getAttribute('data-yearly');

    price.classList.add('fade-out');

    setTimeout(() => {
      price.innerHTML = isChecked ? `${yearlyPrice} <span>/Year</span>` : `${monthlyPrice} <span>/Month</span>`;
      price.classList.remove('fade-out');
    }, 300); 
  });
});




document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const closeModal = document.querySelector(".close-btn");
    const tariffButtons = document.querySelectorAll(".pricing-btn");
    const tariffInput = document.getElementById("selected-tariff");
    const form = document.querySelector('.modal-form');

    // Принудительно скрываем модальное окно при загрузке страницы
    modal.style.display = "none";

    // Открытие модального окна при клике на кнопку
    tariffButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            tariffInput.value = this.parentElement.querySelector(".pricing-item__title").innerText;
            modal.style.display = "flex";
        });
    });

    // Закрытие модального окна при клике на кнопку закрытия
    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Закрытие модального окна при клике вне его
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Отправка формы через AJAX
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = $(this).serializeArray();

        $.ajax({
            url: window.myajax.url,
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                console.log("Успех:", response);

                modal.style.display = "none";

                form.reset();

                setTimeout(() => {
                    Swal.fire({
                        title: "Request submitted!",
                        text: "A manager will contact you in a few minutes",
                        icon: "success",
                        confirmButtonText: "Ок"
                    });
                }, 1000);
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error);
                Swal.fire({
                    title: "Error!",
                    text: "There was an error submitting the request",
                    icon: "error"
                });
            }
        });
    });
});
