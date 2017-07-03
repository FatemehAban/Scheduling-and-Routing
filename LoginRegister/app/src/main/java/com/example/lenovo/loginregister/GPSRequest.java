package com.example.lenovo.loginregister;

import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;


public class GPSRequest extends StringRequest {

    private static final String GPS_URL ="https://fatemehsaeedifar.000webhostapp.com/GPS.php";
    private Map<String,String> params;

    public GPSRequest(String name, String username, double Latitude, double Longitude, Response.Listener<String> Listener){
        super(Request.Method.POST,GPS_URL, Listener, null);
        params = new HashMap<>();
        params.put("name", name);
        params.put("username", username);
        params.put("Latitude", Latitude +"");
        params.put("Longitude", Longitude+"");


    }
    public Map<String,String> getParams(){
        return params;
    }

}
