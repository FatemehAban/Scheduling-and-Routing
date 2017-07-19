package com.example.lenovo.loginregister;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Build;
import android.provider.Settings;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

import org.json.JSONException;
import org.json.JSONObject;

public class DriverAreaActivity extends FragmentActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private TextView tv_GPSlocation;
    private LocationManager locationManager;
    private LocationListener locationListener;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_driver_area);


        Intent intent = getIntent();
        final String name = intent.getStringExtra("name");
        final String username = intent.getStringExtra("username");

        tv_GPSlocation = (TextView) findViewById(R.id.tv_gpsLocation);

        locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);
        locationListener = new LocationListener() {
            @Override
            public void onLocationChanged(Location location) {
                tv_GPSlocation.setText(location.getLatitude() + " , " + location.getLongitude());
                mMap.clear();
                LatLng sydney = new LatLng(location.getLatitude(), location.getLongitude());
                mMap.addMarker(new MarkerOptions().position(sydney));
               // mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));
                float zoomLevel = 18.50f; //This goes up to 21
                mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(sydney, zoomLevel));

                //Sending a GPS Location to server
                //push gps location on server
                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };
                GPSRequestDriver gpsRequest = new GPSRequestDriver(name, username, location.getLatitude(), location.getLongitude(), responseListener);
                RequestQueue queue = Volley.newRequestQueue(DriverAreaActivity.this);
                queue.add(gpsRequest);



            }

            @Override
            public void onStatusChanged(String s, int i, Bundle bundle) {

            }

            @Override
            public void onProviderEnabled(String s) {

            }

            @Override
            public void onProviderDisabled(String s) {
                Intent intent1 = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                startActivity(intent1);
            }
        };
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                requestPermissions(new String[]{
                        Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.ACCESS_COARSE_LOCATION,
                        Manifest.permission.INTERNET}, 10);


                return;

            }

            getGPSLocations();

        }

        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
    }



    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
    }


    private void getGPSLocations() {

            locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, locationListener);
            locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 0, 0, locationListener);

    }
}
