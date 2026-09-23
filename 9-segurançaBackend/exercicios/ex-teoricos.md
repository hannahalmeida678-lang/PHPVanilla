Conceituação OWASP: O que significa a sigla XSS e por que ela é classificada como uma vulnerabilidade no lado do cliente (Client-Side) que deve ser prevenida pelo Back-End?
R: A sigla XSS significa Cross-Site Scripting (Script entre Sites, em tradução livre).O termo original usa a letra "X" em vez de "C" apenas para evitar confusão com o termo CSS (Cascading Style Sheets), utilizado para a estilização de páginas web.Aqui está a explicação de como ela funciona e o motivo de sua classificação:Por que é uma vulnerabilidade no lado do cliente (Client-Side)?O XSS é classificado como Client-Side porque a sua execução e o seu impacto final ocorrem diretamente no navegador do usuário (o cliente), e não no servidor.A vulnerabilidade acontece quando um atacante consegue injetar scripts maliciosos (geralmente em JavaScript) em uma página web que outros usuários vão acessar. Quando o navegador da vítima carrega essa página, ele interpreta o script malicioso como se fosse um código legítimo do próprio site.

Reflected vs Stored: Qual é a diferença entre um ataque XSS Refletido e um XSS Gravado (Stored)? Qual dos dois apresenta maior potencial de estrago para uma empresa e por quê?
R: A principal diferença entre os dois ataques está em onde o código malicioso fica guardado e quantas vítimas ele pode atingir de uma só vez. O XSS Gravado (Stored) apresenta um potencial de estrago significativamente maior para uma empresa do que o XSS Refletido.

Mecanismo de Escapamento: Explique detalhadamente a transformação que a função htmlspecialchars() realiza nos caracteres < e >. Por que o navegador não executa o código após essa transformação?
R: A função htmlspecialchars() transforma os caracteres < e > em suas respectivas entidades HTML, fazendo com que o navegador os interprete puramente como texto (literal) em vez de comandos executáveis.

Flags de Proteção: Qual é a função da flag ENT_QUOTES na chamada de htmlspecialchars()? O que pode acontecer se essa flag for omitida em um campo <input value="...">?
Anti-Alucinação PHP: Por que não devemos utilizar o filtro FILTER_SANITIZE_STRING em projetos modernos desenvolvidos em PHP 8.3
R: A função principal da flag ENT_QUOTES é forçar a conversão de aspas simples (') e aspas duplas (") em suas respectivas entidades HTML (&#039; e &quot;).Se você omitir essa flag em um campo <input value="...">, o comportamento padrão do PHP (que usa a flag ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401 a partir do PHP 8.1) ainda protegeria contra aspas duplas, mas o grande perigo ocorre se o atributo do seu HTML estiver delimitado por aspas simples ou sem aspas.

Validação de E-mail: Qual é a diferença prática entre verificar um e-mail com empty($email) e verificar com filter_var($email, FILTER_VALIDATE_EMAIL)?
R:A diferença prática é que empty($email) apenas checa se a variável está vazia ou não preenchida, enquanto filter_var($email, FILTER_VALIDATE_EMAIL) confere se o texto digitado tem o formato correto de um endereço de e-mail (como a presença do @ e de um domínio válido).

Roubo de Sessão: Como um atacante pode usar uma brecha XSS para capturar o cookie de sessão de um usuário logado?
Segurança em Camadas: Por que sanitizar na entrada (ex: com strip_tags) não elimina a necessidade de codificar na saída com htmlspecialchars()?
R: Um atacante pode usar uma vulnerabilidade Cross-Site Scripting (XSS) para roubar o cookie de sessão injetando um script malicioso (geralmente JavaScript) que é executado no navegador da vítima. Como o script roda no contexto da sessão legítima, ele tem acesso aos dados da página.

