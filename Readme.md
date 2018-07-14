# Marvel Shortcode

[![LENNON](https://img.shields.io/badge/desenvolvido%20por-LENNON-red.svg?longCache=true&style=for-the-badge)](https://lennonalves.com.br)

Com o plugin Marvel *Shortcode* você pode integrar seu website em WordPress com todo o universo da Marvel. Nele você pode receber informações de:

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

Para usar você deve apenas inserir sua Public Key e Private Key da Marvel API no painel do plugin e os shortcodes dentro de páginas de seu Wordpress. Recomenda-se que sejam páginas distintas: uma para listagens e outra para exibição do conteúdo individual.

 - Lista de shortcodes em funcionamento até momento:

```html
[sc_personagens_marvel] //lista de personagens
[sc_personagem_marvel]  //informações individuais do personagem
```

> Em seu **Painel Administrativo -> Configurações -> Marvel SC** você pode configurar as chaves de ativação e as páginas de exibição dos shortcodes.

#### Imagem da Tela:

Screenshot do plugin em funcionamento:

![MARVEL-SC](https://github.com/lennonalvesdias/la-marvel-shortcode/blob/master/screenshot.png?raw=true)

#### Recomendações Extras:

  - Parte do plugin contém classes [Bootstrap], por isso recomendamos a utilização deste framework em seu tema.

   [Bootstrap]: <http://getbootstrap.com/>
