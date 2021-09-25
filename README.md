FEATURES E CORREÇÕES DO PROJETO DURANTE O CURSO

21/09 - laravel
* @csrf -> token para o laravel validar que a requisição é segura
* serviço para criar e deletar as series criados e arquitetados a parte
* delete em cascata
* transaction (DB::transaction, DB::beginTransaction, DB::commit, DB::rollback)
* editar com js + backend adicionado
* adicionado count para ver quantos ep tem na temporada
* adicionada nova rota para acessar os ep das temporadas
* dentro de uma função anônima (callback), precisamos colocar o use () para o php entender que estamos utilizando uma variável por exemplo
* adicionada funcionalidade para marcar os episódios assistidos da série
* adicionada funcionalidade para exibir a quantidade de ep assistidos na tela da temporada
* adicionada funcionalidade de login (php artisan make:auth)

22/09 - laravel
* adicionada autenticação pela rota (middleware)
* criada página de login (sem ser a do laravel)
* login com senha criptografa por Hash
* aprendido a limpar o cache de rotas: php artisan route:cache
* @auth -> verificação se estiver logado, @guest -> verificação se não estiver logado
* php artisan make:middleware Authenticator
* criei meu próprio middleware para validar a autenticação do usuário (adicionei ele ao kernel do laravel para dar um nome)
* middleware -> é um tipo de filtro da requisição, pode ser executado antes ou depois da controller (no caso do laravel)
* teste de integração com phpunit (validando ações com o banco de dados)
* criado .env.testing para conexão com o banco de teste
* teste criados:
	* encontrar episódios assistidos e validar a quantidade
	* encontrar todos episódios assistidos
	* Criar série com 1 temp e 1 ep
	* Remover série com 1 temp e 1 ep
* passos para deploy da aplicação:
	* ao clonar a aplicação no servidor, rodar composer install para instalar as dependecias da pasta vendor, gerar a key do laravel (php artisan key:genereate), 
	alterar a .env APP_ENV para prod, alterar a .env APP_DEBUG para false, Alterar as .env relacionadas ao banco de dados, com o banco criado, rodar as migrations do laravel
	
22/09 - laravel PARTE 3
* criando classe de Email NewSerie
* php artisan make:mail NewSerie

23/09 - laravel PARTE 3
* template de email criado em markdown
* utlizando plataforma mailtrap para capturar os emails de teste
* adicionada credenciais para uso da plataforma na .env
* adicionada funcionalidade para enviar email a cada 5 segundos para cada série criada na plataforma
* tabela para gerenciar as filas de email criada (php artisan queue:table)
* tabela para gerenciar as filas que falharam de email criada (php artisan queue:failed-table)
* alterado no código para não enviar mais o email diretamente e sim coloca-lo em uma fila (->queue)
* php artisan tinker -> acesso a linha de comando com php do laravel
* rodando a fila no laravel php artisan queue:list --tries=1 (listen é usado em ambiente dev e worker em ambiente prd)
* php artisan queue:failed -> lista todos os jobs que falharam
* php artisan queue:retry -> tentar executar os jobs que falharam
* Adicinada classe de eventos (Events > NewSerie) (php artisan make:event NewSerie)
	* para um evento eu preciso de um listener para ficar escutando cada vez que um evento é criado
* Adicionada emição de evento ao cadastrar uma série
* Adicionado listener sendEmailNewSerieAdded (php artisan make:listener sendEmailNewSerieAdded -e NewSerie) 
	* método handle que lida com a execução do evento
* Adicionado listener no provider para que ao disparar o evento o listener escute e execute
* Adicionado listener logNewSerieAdded
* interface ShouldQueue implementada nos listeners para as filas serem executadas de forma assíncrona

24/09 - laravel PARTE 3
* Adicionada migration para add capa na tabela series
* Alterado cadastro para aceitar capa e criada .env FILESYSTEM_DRIVER para disponibilizar o arquivo que foi feito o upload
* Arquivos feitos o upload ficam na pasta storage/app/series, foi executado o php artisan storage:link para 
	fazer um link simbólico entre a pasta public/storage e storage/app/public para que o usuário possa acessar/visualizar o arquivo
* Adicionada mutation na model Serie para pegar o path da capa
* Adicionada funcionalidade de exclusão da capa ao apagar a serie
* Alterada a funcionalidade de exclusão da serie, foi criado um evento para dizer que a série 
	foi apagada e um listener para excluir a capa da serie (php artisan make:event deleteSerie e php artisan make:listener -e deleteSerie deleteCoverSerie)
* Adicionado o listener no provider
* dica: deixando o evento e listener de forma assíncrona -> implements ShouldQueue
* dica: para executar a fila de jobs do laravel -> php artisan queue:listen --tries=1
* criado Job para deletar o arquivo ao excluir uma série
