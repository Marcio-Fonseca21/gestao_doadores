/*// Alternar Menu Lateral
function alternarMenu() {
    const menu = document.getElementById('menuLateral');
    const conteudo = document.getElementById('conteudoPrincipal');
    
    // Usa as classes que você definiu no seu CSS original
    menu.classList.toggle('recolhido');
    conteudo.classList.toggle('expandido');
}

// SPA Dashboard - Mostrar apenas o painel selecionado via Sidebar
document.querySelectorAll('.opcao-menu').forEach(opcao => {
    opcao.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Pega o valor do data-alvo (ex: "inicio", "perfil")
        const alvo = this.dataset.alvo;
        
        // Esconde todos os painéis
        document.querySelectorAll('.painel-conteudo').forEach(p => {
            p.style.display = 'none';
        });
        
        // Mostra o painel correto concatenando o prefixo "painel-"
        const painel = document.getElementById(`painel-${alvo}`);
        if(painel) {
            painel.style.display = 'block';
        }
    });
});

// Editar Dados do Perfil
function editarDados(tipo) {
    const painelPerfil = document.getElementById('painel-perfil');
    const blocos = painelPerfil.querySelectorAll('.conteudo-bloco');
    
    // Define qual bloco será editado (0 para pessoais, 1 para complementares)
    const bloco = tipo === 'pessoais' ? blocos[0] : blocos[1];
    
    bloco.querySelectorAll('p').forEach(p => {
        const strong = p.querySelector('strong');
        const span = p.querySelector('span');
        
        if (strong && span) {
            const label = strong.textContent.replace(':', '');
            const valor = span.textContent;
            // Transforma o texto em input
            p.innerHTML = `<strong>${label}:</strong> <input type="text" value="${valor === '—' ? '' : valor}">`;
        }
    });
}

// Guardar Dados do Perfil
function guardarDados(tipo) {
    const painelPerfil = document.getElementById('painel-perfil');
    const blocos = painelPerfil.querySelectorAll('.conteudo-bloco');
    const bloco = tipo === 'pessoais' ? blocos[0] : blocos[1];
    
    bloco.querySelectorAll('p').forEach(p => {
        const strong = p.querySelector('strong');
        const input = p.querySelector('input');
        
        if (strong && input) {
            const label = strong.textContent.replace(':', '');
            const valor = input.value || '—';
            // Transforma o input de volta em texto/span
            p.innerHTML = `<strong>${label}:</strong> <span>${valor}</span>`;
        }
    });

    // Exibe mensagem de sucesso
    const msgId = tipo === 'pessoais' ? 'msgSucessoPessoais' : 'msgSucessoComplementares';
    const msg = document.getElementById(msgId);
    msg.textContent = 'Dados guardados com sucesso!';
    
    setTimeout(() => { 
        msg.textContent = ''; 
    }, 3000);
}

// Alterar Senha
function alterarSenha() {
    const atual = document.getElementById('senhaAtual').value;
    const novaS = document.getElementById('novaSenha').value;
    const confirma = document.getElementById('confirmarSenha').value;

    if(!atual || !novaS || !confirma) {
        alert('Preencha todos os campos da senha');
        return;
    }
    
    if(novaS !== confirma) {
        alert('A nova senha e a confirmação não coincidem');
        return;
    }

    // Limpa os campos após o "sucesso"
    document.getElementById('senhaAtual').value = '';
    document.getElementById('novaSenha').value = '';
    document.getElementById('confirmarSenha').value = '';

    const msg = document.getElementById('msgSucessoSenha');
    msg.textContent = 'Senha alterada com sucesso!';
    
    setTimeout(() => { 
        msg.textContent = ''; 
    }, 3000);
}



//Apagar

// 1. Função para transformar SPAN em INPUT
function editarDados(secao) {
    const bloco = secao === 'pessoais' ? '.perfil-bloco:nth-child(1)' : '.perfil-bloco:nth-child(2)';
    const spans = document.querySelectorAll(`${bloco} .conteudo-bloco span`);

    spans.forEach(span => {
        const valorAtual = span.innerText === '—' ? '' : span.innerText;
        const id = span.id;
        // Criamos o input com o mesmo valor que estava no span
        span.innerHTML = `<input type="text" id="input_${id}" value="${valorAtual}" style="width: 100%; padding: 5px;">`;
    });
}

// 2. Função para GUARDAR os dados
async function guardarDados(secao) {
    const dados = {};
    
    // Captura todos os inputs criados na seção selecionada
    const bloco = secao === 'pessoais' ? '.perfil-bloco:nth-child(1)' : '.perfil-bloco:nth-child(2)';
    const inputs = document.querySelectorAll(`${bloco} input`);

    if (inputs.length === 0) {
        alert("Clique em Editar primeiro!");
        return;
    }

    inputs.forEach(input => {
        // Remove o prefixo "input_" para pegar o nome original do campo
        const chave = input.id.replace('input_', '').replace('Exibido', '');
        dados[chave] = input.value;
    });

    console.log("Enviando dados:", dados); // Para debug

    try {
        const response = await fetch('/gestao_doadores/public/usuario/atualizarPerfil', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ secao: secao, dados: dados })
        });

        const texto = await response.text(); // Pegamos como texto primeiro para ver se há erros de PHP
        console.log("Resposta do servidor:", texto);
        
        const resultado = JSON.parse(texto);

        if (resultado.status === 'sucesso') {
            const msgId = secao === 'pessoais' ? 'msgSucessoPessoais' : 'msgSucessoComplementares';
            document.getElementById(msgId).innerText = "✅ Guardado com sucesso!";
            setTimeout(() => location.reload(), 1000);
        } else {
            alert("Erro ao guardar: " + (resultado.mensagem || "Erro desconhecido"));
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro de conexão com o servidor.");
    }
}

// Garante que o menu lateral funcione para você testar as abas
document.querySelectorAll('.opcao-menu').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const alvo = this.getAttribute('data-alvo');
        document.querySelectorAll('.painel-conteudo').forEach(p => p.style.display = 'none');
        document.getElementById('painel-' + alvo).style.display = 'block';
    });
});



async function alterarSenha() {
    const senhaAtual = document.getElementById('senhaAtual').value;
    const novaSenha = document.getElementById('novaSenha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    const msg = document.getElementById('msgSucessoSenha');

    // Validações básicas no cliente
    if (!senhaAtual || !novaSenha || !confirmarSenha) {
        alert("Preencha todos os campos da senha.");
        return;
    }

    if (novaSenha !== confirmarSenha) {
        alert("A nova senha e a confirmação não coincidem.");
        return;
    }

    try {
        const response = await fetch('/gestao_doadores/public/usuario/alterarSenha', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ senhaAtual, novaSenha })
        });

        const resultado = await response.json();

        if (resultado.status === 'sucesso') {
            msg.style.color = "green";
            msg.innerText = "✅ Senha alterada com sucesso!";
            // Limpa os campos
            document.getElementById('senhaAtual').value = "";
            document.getElementById('novaSenha').value = "";
            document.getElementById('confirmarSenha').value = "";
        } else {
            alert("❌ Erro: " + resultado.mensagem);
        }
    } catch (error) {
        alert("Erro de conexão ao alterar senha.");
    }
}
*/
// Alternar Menu Lateral
function alternarMenu() {
    const menu = document.getElementById('menuLateral');
    const conteudo = document.getElementById('conteudoPrincipal');

    menu.classList.toggle('recolhido');
    conteudo.classList.toggle('expandido');
}

// SPA Dashboard - Mostrar apenas o painel selecionado via Sidebar
document.querySelectorAll('.opcao-menu').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const alvo = this.getAttribute('data-alvo');

        // Guarda o painel ativo no localStorage
        localStorage.setItem('painelAtivo', alvo);

        document.querySelectorAll('.painel-conteudo').forEach(p => {
            p.style.display = 'none';
        });

        const painel = document.getElementById('painel-' + alvo);
        if (painel) {
            painel.style.display = 'block';
        }
    });
});

// Restaurar painel ativo ao carregar a página
window.addEventListener('load', () => {
    const painel = localStorage.getItem('painelAtivo') || 'inicio';
    document.querySelectorAll('.painel-conteudo').forEach(p => p.style.display = 'none');
    const painelAtivo = document.getElementById('painel-' + painel);
    if (painelAtivo) painelAtivo.style.display = 'block';
});

const estadoOriginal = {
    pessoais: {},
    complementares: {}
};
function editarDados(secao, botao) {
    const bloco = secao === 'pessoais'
        ? '.perfil-bloco:nth-child(1)'
        : '.perfil-bloco:nth-child(2)';

    const spans = document.querySelectorAll(`${bloco} .conteudo-bloco span`);
    const estaEditando = botao.dataset.estado === 'editando';

    // CANCELAR
    if (estaEditando) {
        spans.forEach(span => {
            const id = span.id;
            span.innerText = estadoOriginal[secao][id] || '—';
        });

        botao.innerText = 'Editar';
        botao.dataset.estado = '';
        return;
    }

    // EDITAR
    spans.forEach(span => {
        const id = span.id;
        const valorAtual = span.innerText.trim();

        // Guarda valor original para o caso de cancelar
        estadoOriginal[secao][id] = span.innerText;

        // Se for o campo de histórico, cria um CHECKBOX
        if (id === 'historicoTransfusaoExibido') {
            const isChecked = (valorAtual === 'Sim' || valorAtual === '1') ? 'checked' : '';
            span.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px; padding: 5px;">
                    <input 
                        type="checkbox" 
                        id="input_${id}" 
                        ${isChecked} 
                        style="width: 20px; height: 20px; cursor: pointer;"
                    >
                    <label for="input_${id}" style="cursor: pointer;">Sim</label>
                </div>
            `;
        } else {
            // Para todos os outros campos, mantém o INPUT TEXT original
            const valorInput = valorAtual === '—' ? '' : valorAtual;
            span.innerHTML = `
                <input 
                    type="text" 
                    id="input_${id}" 
                    value="${valorInput}" 
                    style="width: 100%; padding: 5px;"
                >
            `;
        }
    });

    botao.innerText = 'Cancelar';
    botao.dataset.estado = 'editando';
}
// GUARDAR DADOS (sem reload)
async function guardarDados(secao) {
    const dados = {};

    const bloco = secao === 'pessoais'
        ? '.perfil-bloco:nth-child(1)'
        : '.perfil-bloco:nth-child(2)';

    const inputs = document.querySelectorAll(`${bloco} input`);

    if (inputs.length === 0) {
        alert("Clique em Editar primeiro!");
        return;
    }

    inputs.forEach(input => {
        // Remove 'input_' e 'Exibido' para obter a chave exata da coluna do banco
        const chave = input.id.replace('input_', '').replace('Exibido', '');

        if (input.type === 'checkbox') {
            // Se for checkbox (Histórico), envia 1 para marcado e 0 para desmarcado
            dados[chave] = input.checked ? 1 : 0;
        } else {
            dados[chave] = input.value || '—';
        }
    });

    try { 
        const response = await fetch('/gestao_doadores/public/usuario/atualizarPerfil', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ secao: secao, dados: dados })
        });

        const resultado = await response.json();

        if (resultado.status === 'sucesso') {
            // Atualiza os spans com os novos valores visualmente
            Object.keys(dados).forEach(chave => {
                const span = document.getElementById(chave + 'Exibido');
                if (span) {
                    // Se for o campo de histórico, converte o 1/0 para texto "Sim/Não"
                    if (chave === 'historicoTransfusao') {
                        span.innerText = dados[chave] === 1 ? 'Sim' : 'Não';
                    } else {
                        span.innerText = dados[chave];
                    }
                }
            });

            // Limpa estado original daquela seção
            estadoOriginal[secao] = {};

            const botao = document.querySelector(
                secao === 'pessoais'
                    ? '.perfil-bloco:nth-child(1) button'
                    : '.perfil-bloco:nth-child(2) button'
            );

            if (botao) {
                botao.innerText = 'Editar';
                botao.dataset.estado = '';
            }

            const msgId = secao === 'pessoais'
                ? 'msgSucessoPessoais'
                : 'msgSucessoComplementares';

            const msgElement = document.getElementById(msgId);
            if (msgElement) {
                msgElement.innerText = "✅ Guardado com sucesso!";
                setTimeout(() => {
                    msgElement.innerText = '';
                }, 3000);
            }

        } else {
            alert("Erro ao guardar: " + (resultado.mensagem || "Erro desconhecido"));
        }

    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro de conexão com o servidor.");
    }
}

// ALTERAR SENHA (inalterada)
async function alterarSenha() {
    const senhaAtual = document.getElementById('senhaAtual').value;
    const novaSenha = document.getElementById('novaSenha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    const msg = document.getElementById('msgSucessoSenha');

    if (!senhaAtual || !novaSenha || !confirmarSenha) {
        alert("Preencha todos os campos da senha.");
        return;
    }

    if (novaSenha !== confirmarSenha) {
        alert("A nova senha e a confirmação não coincidem.");
        return;
    }

    try {
        const response = await fetch('/gestao_doadores/public/usuario/alterarSenha', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ senhaAtual, novaSenha })
        });

        const resultado = await response.json();

        if (resultado.status === 'sucesso') {
            msg.style.color = "green";
            msg.innerText = "✅ Senha alterada com sucesso!";

            document.getElementById('senhaAtual').value = "";
            document.getElementById('novaSenha').value = "";
            document.getElementById('confirmarSenha').value = "";
        } else {
            alert("❌ Erro: " + resultado.mensagem);
        }
    } catch (error) {
        alert("Erro de conexão ao alterar senha.");
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Delegação de evento para o botão Agendar
    document.body.addEventListener('click', async (e) => {
        if (e.target && e.target.classList.contains('btn-agendar')) {
            e.preventDefault();
            const botao = e.target;
            const campanhaId = botao.dataset.campanha;

            botao.disabled = true;
            const textoOriginal = botao.innerText;
            botao.innerText = 'Aguarde...';

            try {
                const response = await fetch('/gestao_doadores/public/doacao/agendar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ campanha_id: campanhaId })
                });

                const resultado = await response.json();

                if (resultado.status === 'sucesso') {
                    botao.innerText = 'Agendado ✅';
                    botao.classList.add('agendado');
                    botao.style.backgroundColor = '#28a745';
                } else {
                    botao.disabled = false;
                    botao.innerText = textoOriginal;
                    alert('Erro ao agendar: ' + (resultado.mensagem || 'Erro desconhecido'));
                }
            } catch (err) {
                botao.disabled = false;
                botao.innerText = textoOriginal;
                console.error(err);
                alert('Erro de conexão ao agendar.');
            }
        }
    });
});

document.getElementById('formVoluntario')?.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const hospitalId = document.getElementById('voluntario_hospital').value;
    const dataMarcacao = document.getElementById('voluntario_data').value;
    const btn = e.target.querySelector('button');

    btn.disabled = true;
    btn.innerText = 'Agendando...';

    try {
        const response = await fetch('/gestao_doadores/public/doacao/agendar', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                hospital_id: hospitalId, 
                data_marcacao: dataMarcacao,
                tipo_doacao: 'Voluntária'
            })
        });

        const res = await response.json();

        if (res.status === 'sucesso') {
            alert('Agendamento voluntário realizado com sucesso!');
            window.location.reload(); 
        } else {
            alert('Atenção: ' + res.mensagem);
            btn.disabled = false;
            btn.innerText = 'Confirmar Agendamento Voluntário';
        }
    } catch (err) {
        alert('Erro ao conectar com o servidor.');
        btn.disabled = false;
        btn.innerText = 'Confirmar Agendamento Voluntário';
    }
});