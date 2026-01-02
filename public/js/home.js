// Função simples para alertar o agendamento
function agendar(local) {
    alert("Você selecionou: " + local + ".\nEstamos te redirecionando para o formulário de agendamento.");
}

// Pequeno efeito para mudar a cor da navbar ao dar scroll
window.addEventListener('scroll', function() {
    const nav = document.querySelector('.navbar');
    if (window.scrollY > 100) {
        nav.style.padding = "10px 8%";
        nav.style.backgroundColor = "#fff";
    } else {
        nav.style.padding = "15px 8%";
    }

    const btnEntrar = document.querySelector(".btn-nav");

btnEntrar.addEventListener("click", function (e) {
    e.preventDefault();          // impede o #
    btnEntrar.textContent = "Erro";
});

});