#     ZABBIX-clock-digital-for-version-less-than-7.0
 <div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Here is the code for creating the Zabbix clock widget for Zabbix minor versions, below version 7.0, where this functionality is not provided by the Zabbix instructions. 
   This code is relevant, since most projects still use minor versions of Zabbix. As a result, at sites, system engineers receive comments on the standard Zabbix analog clock, 
   which is completely uninformative. This code solves the problem of the lack of an electronic clock in Zabbix by changing the standard Zabbix clock widget, adding the ability
   to select the type of clock, while preserving the other settings. The result of the code is shown in Figures 1 and 2.
  </div>
<p align="center">
  <img src="https://github.com/user-attachments/assets/8fefd4d1-e86f-4106-a209-962cb0eece5d" alt="1">
  <div align="center">
  Figure 1 - Digital display of time in hours
    </div>
</p>


<p align="center">
  <img src="https://github.com/user-attachments/assets/99053205-366b-4c80-87cf-6f2face536bf" alt="2">
    <div align="center">
  Figure 2 - The original analog display of time in hours
    </div>
</p>

 <div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The basic Zabbix instruction for older versions describes how to create a new widget https://www.zabbix.com/documentation/7.0/ru/devel/modules/tutorials/widget.
   Moreover, there is an option to select the time representation in the Zabbix widget. But, unfortunately, old versions are very different from the new version of Zabbix, and therefore it is impossible
   to simply take and replace the widget code with a new one. In the new version, there is a special folder for widgets /zabbix/ui/widgets/, where the widget is simply added, and then it is displayed
   when selected on the network map. In old versions of Zabbix, widgets are registered in 8 PHP client files in the /usr/share/zabbix/ directory.
  </div>
  <div align="justify">
  Files that need to be created or changed in case of widget changes:
  </div>
<pre>
<code>
/usr/share/zabbix/include/classes/html/CClock.php;
/usr/share/zabbix/app/controllers/CControllerWidgetClockView.php;
/usr/share/zabbix/include/classes/widgets/forms/CWidgetFormClock.php;
/usr/share/zabbix/js/widgets/class.widget.clock.js;
/usr/share/zabbix/app/views/monitoring.widget.clock.view.php;
/usr/share/zabbix/include/classes/widgets/views/js/widget.clock.form.view.js.php;
/usr/share/zabbix/include/classes/widgets/views/widget.clock.form.view.php;
/usr/share/zabbix/include/defines.inc.php;
</code>
</pre>

<div align="justify">
     As you can see from their names, you can understand what they are responsible for. 
</div>

1. **/usr/share/zabbix/include/classes/html/CClock.php**  
   — Этот класс отвечает за создание и управление компонентом часов (клиентская часть интерфейса), который отображает текущее время или часы в интерфейсе Zabbix. Он содержит методы для генерации HTML и стилей, связанных с отображением часов.

2. **/usr/share/zabbix/app/controllers/CControllerWidgetClockView.php**  
   — Контроллер, который управляет логикой отображения виджета часов на панели инструментов или в других частях интерфейса. Обрабатывает запросы, связанные с отображением и обновлением часов.

3. **/usr/share/zabbix/include/classes/widgets/forms/CWidgetFormClock.php**  
   — Класс формы для настройки или конфигурации виджета часов. Позволяет пользователю устанавливать параметры отображения, такие как формат времени, часовой пояс и другие настройки.

4. **/usr/share/zabbix/js/widgets/class.widget.clock.js**  
   — JavaScript класс, реализующий клиентскую логику виджета часов на веб-странице. Обеспечивает динамическое обновление времени, анимацию и взаимодействие с пользователем.

5. **/usr/share/zabbix/app/views/monitoring.widget.clock.view.php**  
   — Представление, ответственное за отображение виджета часов в интерфейсе мониторинга. Генерирует HTML-разметку для отображения часов на странице.

6. **/usr/share/zabbix/include/classes/widgets/views/js/widget.clock.form.view.js.php**  
   — PHP-скрипт, который генерирует JavaScript-код для формы конфигурации виджета часов в административной части интерфейса Zabbix.

7. **/usr/share/zabbix/include/classes/widgets/views/widget.clock.form.view.php**  
   — PHP-шаблон или класс представления для формы конфигурации виджета часов, предоставляющий интерфейс для настройки параметров отображения.

8. **/usr/share/zabbix/include/defines.inc.php**  
   — Общий файл с определениями констант, настроек и глобальных переменных, используемых во всем проекте Zabbix.

 <div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To implement the digital clock, I wrote a set of modified files, which I posted on GitHub.
   These files need to be uploaded to your Zabbix by creating a patch or by manually creating a backup copy of the modified files for rollback using the bash commands below. I also uploaded a ready-made patch to the GitHub project.
   It is worth clarifying that I tried installing these changes only on versions 6.0.X, and you should make sure how everything works on your versions. 
  </div>
   <div align="justify">
The /opt/old_clock/ directory is an example of a directory where to save a backup copy of the modified files for rollback. 
  </div>
<pre>
<code>
sudo cp /usr/share/zabbix/include/classes/html/CClock.php /opt/old_clock/;
sudo cp /usr/share/zabbix/app/controllers/CControllerWidgetClockView.php /opt/old_clock/;
sudo cp /usr/share/zabbix/include/classes/widgets/forms/CWidgetFormClock.php /opt/old_clock/;
sudo cp /usr/share/zabbix/js/widgets/class.widget.clock.js /opt/old_clock/;
sudo cp /usr/share/zabbix/app/views/monitoring.widget.clock.view.php /opt/old_clock/;
sudo cp /usr/share/zabbix/include/classes/widgets/views/js/widget.clock.form.view.js.php /opt/old_clock/;
sudo cp /usr/share/zabbix/include/classes/widgets/views/widget.clock.form.view.php /opt/old_clock/ ;
</code>
</pre>


 <div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I recommend creating your own patch before installation and checking the changes that will be applied to Zabbix. The /opt/clock directory is an example of a directory where the GitHub project is unzipped.
</div>

 <div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;How to create a patch. A patch is a very convenient tool that allows you to see changes in a file after a long time. And most importantly, this tool gives you the ability to roll back at any time with one command after installing the patch.
</div>

```bash
     Install 
sudo apt install patch;
     if not installed.
```

<div align="justify">
     To create a patch, you need to use the command 
</div>

```bash
diff -u  "original file" "modified file" | sed 's|+++ «modified file»|+++ «original file»|' >> /opt/clock/Clock.patch;
```
  </div>
   <div align="justify">
     Example commands for creating a patch on any version of Zabbix.
     </div>

```bash
diff -u  /dev/null /opt/clock/CClockDigital.php | sed 's|+++ /opt/clock/CClockDigital.php|+++ /usr/share/zabbix/include/classes/html/CClockDigital.php|' >> /opt/clock/Clock.patch;
diff -u  /usr/share/zabbix/include/classes/html/CClock.php /opt/clock/CClock.php | sed 's|+++ /opt/clock/CClock.php|+++ /usr/share/zabbix/include/classes/html/CClock.php|' >> /opt/clock/Clock.patch;
diff -u  /usr/share/zabbix/app/controllers/CControllerWidgetClockView.php /opt/clock/CControllerWidgetClockView.php | sed 's|+++ /opt/clock/CControllerWidgetClockView.php|+++ /usr/share/zabbix/app/controllers/CControllerWidgetClockView.php|' >> /opt/clock/Clock.patch;
diff -u  /usr/share/zabbix/include/classes/widgets/forms/CWidgetFormClock.php /opt/clock/CWidgetFormClock.php | sed 's|+++ /opt/clock/CWidgetFormClock.php|+++ /usr/share/zabbix/include/classes/widgets/forms/CWidgetFormClock.php|' >> /opt/clock/Clock.patch;
diff -u  /usr/share/zabbix/js/widgets/class.widget.clock.js /opt/clock/class.widget.clock.js | sed 's|+++ /opt/clock/class.widget.clock.js|+++ /usr/share/zabbix/js/widgets/class.widget.clock.js|' >> /opt/clock/Clock.patch;
diff -u  /usr/share/zabbix/app/views/monitoring.widget.clock.view.php /opt/clock/monitoring.widget.clock.view.php | sed 's|+++ /opt/clock/monitoring.widget.clock.view.php|+++ /usr/share/zabbix/app/views/monitoring.widget.clock.view.php|' >> /opt/clock/Clock.patch;
diff -u  /usr/share/zabbix/include/classes/widgets/views/js/widget.clock.form.view.js.php /opt/clock/widget.clock.form.view.js.php | sed 's|+++ /opt/clock/widget.clock.form.view.js.php|+++ /usr/share/zabbix/include/classes/widgets/views/js/widget.clock.form.view.js.php|' >> /opt/clock/Clock.patch;
diff -u  /usr/share/zabbix/include/classes/widgets/views/widget.clock.form.view.php /opt/clock/widget.clock.form.view.php | sed 's|+++ /opt/clock/widget.clock.form.view.php|+++ /usr/share/zabbix/include/classes/widgets/views/widget.clock.form.view.php|' >> /opt/clock/Clock.patch;
```
<div align="justify">
To install the patch, use the command
  </div>
  
```bash
sudo patch -d / -p0 < /opt/clock/Clock.patch;
```
<div align="justify">
To roll back a patch, use the command
  </div>
  
```bash
sudo patch -R -d / -p0 < /opt/clock/Clock.patch;
```

<div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-d /: This option specifies that the current directory for applying the patch will be the root directory (/). 
  This is necessary if the patch contains relative paths to files starting from the root of the file system. 
  </div>
  <div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-p0: This option specifies how many directory levels will be removed from the paths in the patch. 
    -p0 means that no levels will be removed, and the paths in the patch will be used in their original form.
  </div>
   <div align="justify">
An example of patch application is shown in Figure 3.
  </div>
<p align="center">
  <img src="https://github.com/user-attachments/assets/929f4c39-cd1b-4073-9810-584bed14608b" alt="3">
    <div align="center">
  Figure 3 — Example of applying a patch to zabbix-frontend-php
    </div>
  </p>

<div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Another way to set the clock is to simply replace the files being changed with files from the GitHub project.
After downloading the project from GitHub, send the files with the PHP code to the /opt/clock folder or any other folder from which you will copy the files with the replacement, as shown in the bash commands:
 </div>
<pre>
<code>
sudo cp /opt/clock/CClockDigital.php  /usr/share/zabbix/include/classes/html/;
sudo cp /opt/clock/CClock.php  /usr/share/zabbix/include/classes/html/CClock.php;
sudo cp /opt/clock/CControllerWidgetClockView.php /usr/share/zabbix/app/controllers/CControllerWidgetClockView.php;
sudo cp /opt/clock/CWidgetFormClock.php /usr/share/zabbix/include/classes/widgets/forms/CWidgetFormClock.php;
sudo cp /opt/clock/class.widget.clock.js /usr/share/zabbix/js/widgets/class.widget.clock.js;
sudo cp /opt/clock/monitoring.widget.clock.view.php /usr/share/zabbix/app/views/monitoring.widget.clock.view.php;
sudo cp /opt/clock/widget.clock.form.view.js.php /usr/share/zabbix/include/classes/widgets/views/js/widget.clock.form.view.js.php;
sudo cp /opt/clock/widget.clock.form.view.php /usr/share/zabbix/include/classes/widgets/views/widget.clock.form.view.php;
</code>
</pre>

<div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To roll back, use bash commands (if you didn't forget to create a backup copy of the modified files for rollback, as shown above):
   </div>
   
<pre>
<code>
sudo cp /opt/old_clock/CClock.php  /usr/share/zabbix/include/classes/html/CClock.php;
sudo cp /opt/old_clock/CControllerWidgetClockView.php /usr/share/zabbix/app/controllers/CControllerWidgetClockView.php;
sudo cp /opt/old_clock/CWidgetFormClock.php /usr/share/zabbix/include/classes/widgets/forms/CWidgetFormClock.php;
sudo cp /opt/old_clock/class.widget.clock.js /usr/share/zabbix/js/widgets/class.widget.clock.js;
sudo cp /opt/old_clock/monitoring.widget.clock.view.php /usr/share/zabbix/app/views/monitoring.widget.clock.view.php;
sudo cp /opt/old_clock/widget.clock.form.view.js.php /usr/share/zabbix/include/classes/widgets/views/js/widget.clock.form.view.js.php;
sudo cp /opt/old_clock/widget.clock.form.view.php /usr/share/zabbix/include/classes/widgets/views/widget.clock.form.view.php;
</code>
</pre>

<div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The clock code has several settings for the time format parameters in different files CclockDigital.php and the main class.widget.clock.js. Here CclockDigital.php is
  responsible for forming the clock size and time format at the time of updating the widget,
  and class.widget.clock.js is responsible for updating the time per second and, accordingly, the main time format should be entered here. The main lines for setting the time:
   </div>
  
```php
$time = date('H:i:s'); // Get the current time with seconds, set the time format to 'H:i:s'.
 // Set the clock size
        $digitalClock->setAttribute('style', 'width: '.$this->width.'px; height:'.$this->height.'px; font-size: 10em; margin-top: 60px;'); // Increase the font
// Update the content of the digital clock element, set the time format to 'H:i:s'
   document.querySelector('.digital-clock').innerText = `${hours}:${minutes}:${seconds}`;
```

<div align="justify">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The clock type selection, as in Figure 4, is written to the widget_field table of the zabbix database. 
  A record in this table appears only when a non-default type (Analog) is selected, the clock_type row is set to 0; the creation of this record is located in the CwidgetFormClock.php file:
   </div>
   
```php
		 		// Select source type field.
		$field_source_type = (new CWidgetFieldRadioButtonList('clock_type', _('Тип часов'), [
			0 => _('Аналоговые'),
			1 => _('Цифровые')
		]))
			->setDefault(1)
			->setAction('ZABBIX.Dashboard.reloadWidgetProperties()')
			->setModern(true);

		if (array_key_exists('clock_type', $this->data)) {
			$field_source_type->setValue($this->data['clock_type']);
		}
```
  </div>
   <div align="justify">
    and in the CcontrollerWidgetClockView.php file, the following type of processing is performed:
     </div>
     
```php
$clock_type1 = true;
switch ($fields['clock_type']) {
    case 0:
        $clock_type1 = false;
        break;
    case 1:
        $clock_type1 = true;
        break;
}
```
  <p align="center">
  <img src="https://github.com/user-attachments/assets/820ccae7-4bae-46bf-b284-8b50df1850b7" alt="4">
      <div align="center">
  Figure 4 - New function for selecting time representation - analog or digital
    </div>
   </p>
