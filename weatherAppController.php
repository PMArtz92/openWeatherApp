<?xml version="1.0" encoding="UTF-8"?>
<proxy xmlns="http://ws.apache.org/ns/synapse"
       name="WeatherAPI"
       transports="https,http"
       statistics="disable"
       trace="disable"
       startOnLoad="true">
    <target>
        <inSequence>
            <property name="uri.var.lat"
                      expression="$url:lat"
                      scope="default"
                      type="STRING"/>
            <property name="uri.var.lon"
                      expression="$url:lon"
                      scope="default"
                      type="STRING"/>
            <call>
                <endpoint>
                    <http uri-template="http://nominatim.openstreetmap.org/reverse?lat={uri.var.lat}&amp;lon={uri.var.lon}"/>
                </endpoint>
            </call>
            <property name="uri.var.city"
                      expression="//reversegeocode/addressparts/city"
                      scope="default"
                      type="STRING"/>
            <property name="uri.var.appid"
                      value="174e64c6c78872d28494a94c1d450c59"
                      scope="default"
                      type="STRING"/>
            <send>
                <endpoint>
                    <http uri-template="http://api.openweathermap.org/data/2.5/weather?q={uri.var.city}&amp;appid={uri.var.appid}"/>
                </endpoint>
            </send>
        </inSequence>
        <outSequence>
            <payloadFactory media-type="json">
                <format>{
                    "name":"$1",
                    "main":"$2",
                    "description":"$3",
                    "icon":"$4",
                    "temp":"$5",
                    "temp_min":"$6",
                    "temp_max":"$7",
                    "pressure":"$8",
                    "humidity":"$9",
                    "windspeed":"$10",
                    "country":"$11",
                    "sunrise":"$12",
                    "sunset":"$13",
                    "cod":"$14"
                    }</format>
                <args>
                    <arg expression="$.name" evaluator="json"/>
                    <arg expression="$.weather[0].main" evaluator="json"/>
                    <arg expression="$.weather[0].description" evaluator="json"/>
                    <arg expression="$.weather[0].icon" evaluator="json"/>
                    <arg expression="$.main.temp" evaluator="json"/>
                    <arg expression="$.main.temp_min" evaluator="json"/>
                    <arg expression="$.main.temp_max" evaluator="json"/>
                    <arg expression="$.main.pressure" evaluator="json"/>
                    <arg expression="$.main.humidity" evaluator="json"/>
                    <arg expression="$.wind.speed" evaluator="json"/>
                    <arg expression="$.sys.country" evaluator="json"/>
                    <arg expression="$.sys.sunrise" evaluator="json"/>
                    <arg expression="$.sys.sunset" evaluator="json"/>
                    <arg expression="$.cod" evaluator="json"/>
                </args>
            </payloadFactory>
            <send/>
        </outSequence>
    </target>
    <description/>
</proxy>