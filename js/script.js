// script.js

document.addEventListener('DOMContentLoaded', () => {
    // Função para atualizar o contador de itens no carrinho
    function atualizarContadorCarrinho() {
        fetch('atualizar-carrinho.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('carrinho-contador').textContent = data.numeroDeItens;
            })
            .catch(error => console.error('Erro ao atualizar o contador do carrinho:', error));
    }

    // Atualiza o contador quando a página é carregada
    atualizarContadorCarrinho();

    // Adiciona um ouvinte de eventos para todos os formulários de adicionar ao carrinho
    document.querySelectorAll('.adicionar-carrinho').forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault();  // Impede o envio padrão do formulário
            const id = form.getAttribute('data-id');
            const nome = form.getAttribute('data-nome');

            fetch('adicionar-ao-carrinho.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    acao: 'add',
                    id: id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    atualizarContadorCarrinho();
                    // Mostra uma mensagem de sucesso com o nome do produto
                    const mensagem = `Produto "${nome}" adicionado ao carrinho!`;
                    const mensagemDiv = document.createElement('div');
                    mensagemDiv.className = 'mensagem-carrinho';
                    mensagemDiv.textContent = mensagem;
                    document.body.appendChild(mensagemDiv);

                    // Remove a mensagem após 3 segundos
                    setTimeout(() => {
                        mensagemDiv.remove();
                    }, 3000);
                } else {
                    console.error(data.mensagem);
                }
            })
            .catch(error => console.error('Erro ao adicionar ao carrinho:', error));
        });
    });
});

  // Função para atualizar o carrinho via AJAX
  function updateCart(id) {
    const quantity = document.getElementById('quantity-' + id).value;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "carrinho.php?acao=up", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload(); // Atualiza a página após a resposta
        }
    };
    xhr.send("prod[" + id + "]=" + quantity); // Envia a quantidade atualizada para o servidor
}
{
var preco = $('#preco').maskMoney()
}
