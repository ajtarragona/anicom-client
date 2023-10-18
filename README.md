
# ANICOM client
Client Laravel d'accés al WS d'ANICOM.
ANICOM és un registre d'animals de companyia de la Generalitat de Catalunya:
https://mediambient.gencat.cat/ca/05_ambits_dactuacio/patrimoni_natural/animals_companyia_experimentacio/animals_companyia/anicom/



[![Latest Stable Version](http://poser.pugx.org/ajtarragona/anicom-client/v)](https://packagist.org/packages/ajtarragona/anicom-client) 
[![Total Downloads](http://poser.pugx.org/ajtarragona/anicom-client/downloads)](https://packagist.org/packages/ajtarragona/anicom-client) 
[![Latest Unstable Version](http://poser.pugx.org/ajtarragona/anicom-client/v/unstable)](https://packagist.org/packages/ajtarragona/anicom-client) 
[![License](http://poser.pugx.org/ajtarragona/anicom-client/license)](https://packagist.org/packages/ajtarragona/anicom-client) 
[![PHP Version Require](http://poser.pugx.org/ajtarragona/anicom-client/require/php)](https://packagist.org/packages/ajtarragona/anicom-client)


<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Instalació
```bash
composer require ajtarragona/anicom-client:dev-main"
``` 

## Configuració
Pots configurar el paquet a través de l'arxiu `.env` de l'aplicació. Aquests son els parámetres disponibles :

Paràmetre |  Descripció  | Valors
--- | --- | --- 
ANICOM_ENVIRONMENT | Entorn pre-producció o producció | <ins>`pre`</ins> / `pro`
ANICOM_URL_PRO | Url base de la API en producció  | 
ANICOM_USER_PRO | Usuari de producció |  
ANICOM_PASSWORD_PRO  | Password de producció | 
ANICOM_ID_REGISTRO_PRO  | ID de registre  de producció |  proporcionat per ANICOM
ANICOM_URL_PRE | Url base de la API en pre-producció  | 
ANICOM_USER_PRE | Usuari de pre-producció |  
ANICOM_PASSWORD_PRE  | Password de pre-producció | 
ANICOM_ID_REGISTRO_PRE  | ID de registre  de pre-producció |  proporcionat per ANICOM
ANICOM_DEBUG  | Mode debug (habilita més logs) | `true` / <ins>`false`</ins>



Alternativament, pots publicar l'arxiu de configuració del paquet amb la comanda:

```bash
php artisan vendor:publish --tag=ajtarragona-anicom-config
```

Això copiarà l'arxiu `anicom.php` a la carpeta `config`.

 

## Ús
Un cop configurat, el paquet està a punt per fer-se servir.
Ho pots fer de les següents maneres:


**A través d'una `Facade`:**
```php
use Anicom;
...
public  function  test(){
    $animal=Anicom::consultaAnimal('123456');
    ...
}
```

Per Laravel < 5.6, cal registrar l'alias de la Facade a l'arxiu `config/app.php` :
 
```php
'aliases'  =>  [
    ...
    'Anicom'  =>  Ajtarragona\Anicom\Facades\Anicom::class
]
```

  

**Vía Injecció de dependències:**
Als teus controlladors, helpers, model:


```php
use Ajtarragona\Anicom\Providers\AnicomProvider;
...

public  function  test(AnicomProvider  $client){
    $animal=$client->consultaAnimal('123456');
    ...
}
```

**Vía funció `helper`:**
```php
...
public  function  test(){
    $animal=anicom()->consultaAnimal('123456');
    ...
}
```

  
  

## Funcions

Funció | Descripció | Paràmetres | Retorn 
--- | --- | --- | --- 
**consultaAnimal** | Retorna un animal a partir del seu id (codi de xip) |  `string:$id_animal` | Objecte animal
**consultaPropietari** | Retorna un propietari a partir del seu id (DNI, nif, passaport) | `string:$id_propietari`|  Objecte propietari 
**altaPropietari** | Dona d'alta un propietari | `array:$camps`  <br/>Veure [taula camps](#camps_propietari)| Objecte propietari 
**altaAnimal** | Dona d'alta un animal | `array:$camps` <br/>Veure [taula camps](#camps_animal) | Objecte animal
**canviPropietari** | Canvia de propietari un animal, passant l'id dels dos | `string:$id_animal`,`string:$id_nou_prop`|  Objecte propietari
**modificacioAnimal** | Modifica dades d'un animal | `string:$id_animal`, `array:$camps` |  Objecte animal
**modificacioPropietari** | Modifica dades d'un propietari | `string:$id_propietari`, `array:$camps`|  Objecte propietari
**baixaAnimal** | Dona de baixa un animal | `string:$id_animal`, `int:$motiu`, `data:$data_baixa` <br/>Veure [taula motius baixa](#taula_motius_baixa) | Missatge
**recuperaAnimal** | Recupera un animal de baixa | `string:$id_animal` | Missatge

<a name="camps_propietari"></a>
### Camps propietari
Nom camp | Descripció | Obligatori | Valors
--- | --- | --- | --- 
tipus_persona | Tipus de persona | No | <ins>1:Persona física</ins>, 2:Persona jurídica, 3:Organisme
tip_document | Tipus de document | No | Veure [taula](#tipus_document) 
document | Document d'identificació (DNI, etc.) | Si |
nom | Nom del propietari | Si | 
cognoms  | Cognoms del propietari | Si | 
rao_social | Raó social | Si (si tip_document = 2 o 3) |
sexe | Sexe del propietari | Si | 1:Dona,  2:Home, 3:No binari
tip_document_repres | Tipus de document representant| No | Veure [taula](#tipus_document) 
document_repres | Document d'identificació del representant | No |
nom_repres | Nom del representant | No | 
cognoms_repres | Cognoms del representant | No | 
tipus_via | Tipus de via | Si | Veure [taula](#tipus_via) 
via | Nom de via | Si | 
numero | Numero de via | Si | 
bloc | Bloc | No | 
escala | Escala | No | 
pis | Pis | No | 
porta | Porta | No | 
municipi | Nom de via | Si | Veure [taula](#municipis) 
codi_postal | Codi postal | No | 
pais | Codi de pais | No | 
telefon | Telèfon | Si | 
telefon2 | Telèfon 2 | Si | 
telefon3 | Telèfon 3 | Si | 
email | Email | No | 
email2 | Email 2 | No | 
major_18 | Major 18 | No | S - N
observacions | Observacions | No | 


```php
...
public  function  test(){
    $animal=anicom()->altaPropietari([
        'tipus_persona' => 1,    
        'tip_document' => 1,    
        'document' => '12345678J',    
        'nom' => 'PEPITO',    
        'cognoms' => 'PEREZ LOPEZ',    
        'rao_social' => '',    
        'sexe' => 2,    
        'ambit' => 1,    
        'tipus_via' => 1,    
        'via' => 'FAKE STREET',   
        'numero' => 1,   
        'municipi' => 17118,    
        'telefon' => '666666666'
    ]);
    
}
```

<a name="camps_animal"></a>
### Camps animal
Nom camp | Descripció | Obligatori | Valors
--- | --- | --- | --- 
data_alta | Data d'alta | No | Es posarà per defecte la data actual. Si es passa, ha de ser en format dd/mm/YYYY
identificacio | Codi de xip de l'animal | Si | 
tip_identificacio | Codi del tipus d'identificació | No | <ins>1:Xip</ins>, 2:Tatuatge 
lloc_marcatge | Lloc de marcatge del xip |  No | Veure [taula](#llocs_de_marcatge) 
especie | Codi d'espècie |  Si | 1:Gos , 2:Gat, 3:Fura
sexe | Sexe de l'animal  | No | <ins>1:Mascle</ins>, 2:Femella
raca | Codi de raça |  No | Veure taula 
idPkPare | Identificador del propietari | No| 
nom_animal | Nom de l'animal
num_placa | Numero de placa | No | 
esterilitzat | Esterilitzat | No | S - N
raca | Codi de raça de l'animal |  No | Veure a ANICOM
varietat_raca | Varietat de raça de l'animal |  No |
perillos | Animal perillós | No | S - N
assistencia | Animal d'assistència | No | S - N
mateixa_adreca | Mateixa adreça que propietari | No | S - N
tipus_via_anim | Tipus de via | Si | Veure [taula](#tipus_via) 
via_anim | Nom de via | Si | 
numero_anim | Numero de via | Si | 
bloc_anim | Bloc | No | 
escala_anim | Escala | No | 
pis_anim | Pis | No | 
porta_anim | Porta | No | 
municipi_anim | Nom de via | Si | Veure [taula](#municipis) 
codi_postal_anim | Codi postal | No | 
observacions_anim | Observacions | No | 
proteccio_dades | Protecció de dades | No | S - N



```php
...
public  function  test(){
    $animal=anicom()->altaAnimal([
        'identificacio' => '123456789012345',    
        'lloc_marcatge' => 1,    
        'especie' => 1,    //Gos
        'sexe' => 1,    //mascle
        'raca' => 2,    //fox terrier
        'idPkPare' => '11111116T'
        'nom_animal'=>'Bobby',
    ]);
    
}
```


<a name="llocs_de_marcatge"></a>
#### Llocs de marcatge
Codi | Valor
--- | --- 
**0**  | 	No Determinat
1 | 	Orella
2 | 	Engonal
3 | 	Coll
4 | 	Llom
5 | 	Creu
8 | 	Múscul pectoral

<a name="tipus_document"></a>
#### Tipus de document identificador
Codi | Valor
--- | --- 
**1** |	NIF
2 |	NIE
3 |	Passaport
6 |	NIF de PJ
7 |	Doc. Identificació estranger
8 |	No classificat




<a name="taula_motius_baixa"></a>
#### Motius de baixa
Codi | Valor
--- | --- 
1 |	Baixa del registre
2 |	Baixa del cens municipal
3 |	Baixa per mort
4 |	Baixa per canvi de propietari





