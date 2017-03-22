# Marvel Shortcode by Lennon Alves

[![LENNON](http://lennonalves.xyz/img/desenvolvidopor.png)](https://lennonalves.com)

Com o plugin Marvel Shortcode você pode integrar seu website em WordPress com todo o universo da Marvel. Nele você pode receber informações de:

  - Personagens
  - Histórias em Quadrinhos (HQ)
  - Criadores
  - Eventos
  - Séries
  - Histórias

#### Como instalar:

  - Carregue o zip do arquivo de plugin pelo painel administrativo de seu WordPress
  - Envie via FTP para a pasta /wp-content/plugins

#### Como usar:

  - Para usar você deve apenas inserir a shortcode dentro de seu site. Recomenda-se que seja dentro de uma página.

```sh
[sc_personagens_marvel]
```
> O código acima exibe a lista de todos os personagens do Universo Marvel.

```sh
[sc_personagem_marvel]
```

> O código acima exibe informações de um personagem específico, recebido pelo parâmetro ?id=XXXXX da url.

- Para não utilizar outros plugins como dependências, as linkagens entre a lista e as informações do personagens estão sendo fixas. Assim que implementada uma nova solução, o repositório será atualizado.

> As URLS de direcionamento podem ser editadas em seu Painel Admnistrativo -> Configurações -> Marvel SC

#### Imagem da Tela:

Screenshot do plugin em funcionamento:

![MARVEL-SC](https://github.com/lennonalvesdias/la-marvel-shortcode/blob/master/screenshot.png?raw=true)

#### Recomendações Extras:

  - Parte do plugin contém classes [Bootstrap], por isso recomendamos a utilização deste framework em seu tema.

###### LIVRE PARA TODOS. QUER CONTRIBUIR? ME ENVIE UM [E-MAIL].

   [Bootstrap]: <http://getbootstrap.com/>
   [E-MAIL]: <mailto:lennonalvesdias@gmail.com>