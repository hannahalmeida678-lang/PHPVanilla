## LISTA DE EXERCÍCIOS: PROCESSAMENTO HTTP E FORMULÁRIOS

### Parte A: Exercícios Teóricos de Fixação

1. **Diferença Estrutural:** Explique a diferença física entre onde os dados são anexados em uma requisição `GET` e em uma requisição `POST`.
R:  Requisição GET: Os dados são anexados diretamente na URL, logo após o caractere ?, formando o que chamamos de Query String (cadeia de consulta).Requisição POST: Os dados são embutidos e enviados de forma oculta dentro do corpo (body) da requisição HTTP, separados dos cabeçalhos por uma linha em branco.

2. **Segurança e Privacidade:** Por que senhas de usuário nunca devem ser enviadas via método `GET`? Cite pelo menos dois locais onde essa senha ficaria gravada de forma insegura.
R: Senhas de usuário nunca devem ser enviadas via método GET porque esse método anexa os dados diretamente na URL da requisição (como ?senha=123). Isso expõe a senha em texto limpo, quebrando o princípio de confidencialidade.

3. **Coalescência Nula:** Por que a instrução `$nome = $_POST['nome'];` dispara um `Warning` na primeira vez que a página é carregada no navegador? Como o operador `??` resolve isso?

R: A instrução $nome = $_POST['nome']; dispara um Warning (Undefined array key "nome") porque, no primeiro carregamento da página, o formulário ainda não foi enviado, fazendo com que a chave "nome" não exista dentro da superglobal $_POST.

4. **Idempotência:** O que significa dizer que uma requisição `GET` é idempotente? Por que atualizar ou deletar dados no banco usando links `GET` é uma má prática de segurança?

R: Uma requisição GET ser idempotente significa que fazer a mesma requisição múltiplas vezes produzirá o mesmo resultado no servidor que se fosse feita uma única vez, sem causar efeitos colaterais adicionais.


5. **Validação Client vs Server:** Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque colocou `required` e `type="email"` em todas as tags HTML. Explique por que essa afirmação é falsa. 

R: A afirmação do desenvolvedor júnior é falsa porque a validação no lado do cliente (HTML/JavaScript) serve apenas para melhorar a experiência do usuário (UX), enquanto a segurança real depende exclusivamente da validação no lado do servidor. Qualquer validação feita no navegador pode ser facilmente burlada ou ignorada por um usuário malintencionado.

6. **XSS e Sanitização:** Qual é o risco de exibir dados vindos de um `$_POST` diretamente na tela sem utilizar `htmlspecialchars()`?
R: O risco de exibir dados do $_POST diretamente na tela sem htmlspecialchars() é a vulnerabilidade de Cross-Site Scripting (XSS), que permite a execução de scripts maliciosos (como JavaScript) no navegador de qualquer usuário que visualizar a página.


7. **Sticky Forms:** O que é a técnica de *Sticky Forms* e qual é o seu impacto na experiência do usuário (UX)?

*R:* Sticky Forms (ou formulários persistentes) é uma técnica de desenvolvimento web que mantém os dados preenchidos pelo usuário após o envio do formulário, caso ocorra algum erro de validação. Em vez de limpar todos os campos e forçar a pessoa a digitar tudo novamente, a página recarrega preservando as informações corretas e destacando apenas o que precisa ser corrigido.


8. **DevTools:** Como você utilizaria a aba *Network* do navegador para comprovar que um formulário foi enviado via `POST` e não via `GET`?

*R: Para comprovar que um formulário foi enviado via POST e não via GET, você deve abrir o DevTools (F12 ou Ctrl+Shift+I), acessar a aba Network (Rede) e seguir os passos abaixo:

1. **Ative a gravação:** Certifique-se de que o círculo vermelho de gravação está ativo.
2. **Envie o formulário:** Preencha e envie o formulário na página web.
3. **Localize a requisição:** Procure pelo nome do arquivo ou endpoint na coluna Name.
4. **Verifique o método:** Clique na requisição e olhe a sub-aba Headers (Cabeçalhos).