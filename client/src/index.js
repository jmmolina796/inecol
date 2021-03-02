import '../../public/css/estilos2.styl';
import '../../public/css/styles.css';

import './plugins/materialValidation';

import './modules/window';
import './modules/home';
import './modules/modal';
import './modules/alert';
import './modules/message';
import './modules/filesMenu';
import './modules/levelModules';
import './modules/routing';
import './modules/session';
import './modules/search';
import './modules/chat';

import './modules/configuration';
import './modules/administrator';
import './modules/adviser';
import './modules/judge';
import './modules/alliance';
import './modules/institution';
import './modules/teacher';
import './modules/registerTeacher';
import './modules/school';
import './modules/project';
import './modules/trainings';
import './modules/trainers';
import './modules/trainingGroups';
import './modules/projectWall';
// import './modules/module';
import './modules/schoolYear';

import configurationLoad from './shared/configurationLoad';
import loadedImagesPage from './shared/loadedImagesPage';

configurationLoad();
loadedImagesPage();