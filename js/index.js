var preco = $('#preco').maskMoney()

document.addEventListener('DOMContentLoaded', function() {
    // Captura o evento de mudança nos campos de quantidade
    var inputsQuantidade = document.querySelectorAll('.quantidade-produto');

    inputsQuantidade.forEach(function(input) {
        input.addEventListener('change', function() {
            // Submete o formulário quando a quantidade é alterada
            document.getElementById('formCarrinho').submit();
        });
    });
});
