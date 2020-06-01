<?php

namespace GobiernoAmigoMovil\Util;

interface Enum
{
    
    const PORT_DEFAULT  = "80";
    
    const SERVER_EXTERNAL  = "200.105.237.155";//srvidor de los rest que consumo el app
    const PORT_SERVER_EXTERNAL  = "8080";
    const URL_SERVER_EXTERNAL  = "http://"."200.105.237.155".":"."8080";
    const URL_SERVER_EXTERNAL_80_PORT  = "https://".SERVER_EXTERNAL;
    
    const URL_MOVIL_EXTERNAL  = "http://movil.santodomingo.gob.ec/api";//
    
    const ANIO="2019";
   
    
    
    //web services rest santo domingo
    const pro_uid = '3075972435ce5b51e8dd157022654944';
    const usr_uid = '50693659653d97e0bdbf5d7020786619';
    const tas_uid = '3121041645ce5b7a066a212040358901';
    const constas_uid = '3121041645ce5b7a066a212040358901';       
    const regUsudesti = '4011361204e1e19a8323e46042831398';
    const regUsulogin = '50693659653d97e0bdbf5d7020786619';
    const idTramite = 146;
    const client_id='KZXDDXVPQRKAZVAOCWIAUEETMJLXPSPZ';
    const client_secret= '7018806005d1e32bc93c0e5039251135';
    const inp_doc_uid= '3357559745cf584ee2535f2003662692';//subir archivos
    
    //constantes para rest_seguimiento
    const codtramite = 146;
    const usuario = 'En Linea con su Alcalde Constructor (App Movil)';
    const coddepa = '11923901253d97da0efec69007666748';
    const codusu = '50693659653d97e0bdbf5d7020786619';
    const codlogin = '1891365065d1e2d5259d4c4097390165';
    
    
    //usuario contrasenia santo domingo
    const user_process_maker = 'corvustec';
    const pass_process_maker = 'corvustec123456';
    
    //metodos rest externos santo domingo
    const rest_autencion= '/workflow2019/oauth2/token';
    const rest_new_denuncia='/api/1.0/workflow2019/cases/impersonate';
    //const rest_change_state1='/api/1.0/workflow2019/cases/';//pendien te de ver si se usa 
   // const rest_change_state2='/execute-trigger/7724974495d2f99c5222851074073758';//pendiente de ver si se usa
    const rest_change_state='/api/1.0/workflow2019/extrarest/case/status/';
    const rest_seguimiento= '/seguimiento/nuevo';
    const rest_cabecera_caso= '/cabecera/';
    const rest_detalle_caso= '/detalle/';
    
    const rest_upload_file1='/api/1.0/workflow2019/cases/';
    const rest_upload_file2='/input-document';
    
    //send mail contact
    const HOST_CONTACT  = 'smtp.gmail.com';
    const NAME_CONTACT  = 'Gobierno Amigo';
    const MAIL_CONTACT  = 'joseauquilla23@gmail.com';
    const PASS_CONTACT  = '231987051';
    const HOST_CIFRADO  = 'tls';
    const HOST_PORT_SMTP  = 587;
    
    const LINK_RECUPERA_CONTRASENIA  = '<a href="https://www.thesitewizard.com/" target="_blank">thesitewizard.com</a>';
    
    
    
    
   // https://200.105.237.155:8080/api/1.0/wo/departments 
}
