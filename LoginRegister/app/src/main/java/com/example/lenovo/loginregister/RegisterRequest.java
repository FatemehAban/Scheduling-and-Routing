package com.example.lenovo.loginregister;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.lang.reflect.Method;
import java.util.HashMap;
import java.util.Map;
import java.util.Stack;

/**
 * Created by lenovo on 17/6/2017.
 */

public class RegisterRequest extends StringRequest {
    private static final String REGISTER_REQUEST_URL ="https://fatemehsaeedifar.000webhostapp.com/Register.php";
    private Map<String,String> params;

    public RegisterRequest(String name, String username, int age, String password, String gender, Response.Listener<String> Listener){
        super(Method.POST,REGISTER_REQUEST_URL, Listener, null);
        params = new HashMap<>();
        params.put("name", name);
        params.put("username", username);
        params.put("password", password);
        params.put("age", age + "");
        params.put("gender", gender);
        params.put("name", name);

    }
    public Map<String,String> getParams(){
        return params;
    }

}
