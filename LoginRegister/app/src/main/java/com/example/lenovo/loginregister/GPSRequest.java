package com.example.lenovo.loginregister;

import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;


public class GPSRequest extends StringRequest {

    private static final String GPS_URL ="http://www.fudzorro.com/ant/GPS.php";
    private Map<String,String> params;

    public GPSRequest(String name, String username, double latitude, double longitude, Response.Listener<String> Listener){
        super(Request.Method.POST,GPS_URL, Listener, null);
        params = new HashMap<>();
        params.put("name", name);
        params.put("username", username);
        params.put("latitude", latitude +"");
        params.put("longitude", longitude+"");


    }
    public Map<String,String> getParams(){
        return params;
    }

}
