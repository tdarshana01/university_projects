import streamlit as st
import numpy as np
import pandas as pd
import pickle
import joblib
import os
import json

model = None
data_columns = None
columns_to_scale = None
scale = None

def load_artifacts():
    global model, data_columns, scale, columns_to_scale

    base_path = os.path.dirname(__file__)
    columns_path = os.path.join(base_path,'artifacts','data_columns.json')
    scale_columns_path = os.path.join(base_path,'artifacts','columns_to_scale.json')
    model_path = os.path.join(base_path,'artifacts','model.pickle')
    scale_path = os.path.join(base_path,'artifacts','scaler.pickle')

    with open(columns_path,'r') as f:
        data = json.load(f)
        data_columns = data['data_columns']

    with open(scale_columns_path,'r') as f:
        data = json.load(f)
        columns_to_scale = data['columns_to_scale']

    with open(model_path,'rb') as f:
        model = pickle.load(f)

    with open(scale_path,'rb') as f:
        scale = joblib.load(f)


def estimate_appendicities(Age, BMI, Sex, Height, Weight, Alvarado_Score, Paedriatic_Appendicitis_Score, Appendix_on_US,
                           Appendix_Diameter, Migratory_Pain, Lower_Right_Abd_Pain, Contralateral_Rebound_Tenderness,
                           Coughing_Pain, Nausea, Loss_of_Appetite, Body_Temperature, WBC_Count, Neutrophil_Percentage,
                           Neutrophilia, RBC_Count, Hemoglobin, RDW, Thrombocyte_Count, Ketones_in_Urine, RBC_in_Urine,
                           WBC_in_Urine, CRP, Dysuria, Stool, Peritonitis, Psoas_Sign, Ipsilateral_Rebound_Tenderness,
                           Free_Fluids):
    load_artifacts()

    X = np.zeros(len(data_columns))
    fields = {
        'Sex':Sex,
        'Appendix_on_US': Appendix_on_US,
        'Migratory_Pain': Migratory_Pain,
        'Lower_Right_Abd_Pain': Lower_Right_Abd_Pain,
        'Contralateral_Rebound_Tenderness': Contralateral_Rebound_Tenderness,
        'Coughing_Pain': Coughing_Pain,
        'Nausea': Nausea,
        'Loss_of_Appetite': Loss_of_Appetite,
        'Neutrophilia': Neutrophilia,
        'Ketones_in_Urine': Ketones_in_Urine,
        'RBC_in_Urine': RBC_in_Urine,
        'WBC_in_Urine': WBC_in_Urine,
        'Dysuria': Dysuria,
        'Stool': Stool,
        'Peritonitis': Peritonitis,
        'Psoas_Sign': Psoas_Sign,
        'Ipsilateral_Rebound_Tenderness': Ipsilateral_Rebound_Tenderness,
        'Free_Fluids': Free_Fluids
    }

    for feature, value in fields.items():
        column_name = f"{feature}_{value}"
        if column_name in data_columns:
            index = data_columns.index(column_name)
            X[index] = 1

    numerical_input = np.array([[Age, BMI, Height, Weight, Alvarado_Score, Paedriatic_Appendicitis_Score,
                                 Appendix_Diameter, Body_Temperature, WBC_Count, Neutrophil_Percentage, RBC_Count,
                                 Hemoglobin, RDW, Thrombocyte_Count, CRP]])
    scaled_values = scale.transform(numerical_input)[0]

    columns_to_scale = ['Age', 'BMI', 'Height', 'Weight', 'Alvarado_Score',
                        'Paedriatic_Appendicitis_Score', 'Appendix_Diameter',
                        'Body_Temperature', 'WBC_Count', 'Neutrophil_Percentage',
                        'RBC_Count', 'Hemoglobin', 'RDW', 'Thrombocyte_Count', 'CRP']

    for i, column in enumerate(columns_to_scale):
        col_index = data_columns.index(column)
        X[col_index] = scaled_values[i]

    prediction = model.predict([X])[0]
    result = ''
    if prediction == 1:
        result = 'Appendicitis'
    else:
        result = 'No appendicitis'

    probability = model.predict_proba([X])[0][1]
    return result, probability

def main():
    html_temp = """
        <div style="background: linear-gradient(to right, #11998e, #38ef7d); padding: 15px 10px; border-radius: 12px; box-shadow: 0px 4px 10px rgba(0,0,0,0.2);">
            <h2 style="color: white; text-align: center; font-family: 'Segoe UI', sans-serif; margin: 0;">Pediatric Appendicitis Prediction App</h2>
            <p style="color: #f0fdf4; text-align: center; font-size: 14px; margin-top: 5px;">Predict which patients are most likely to have appendicitis and take action early.</p>
        </div>
        <br>
    """

    st.markdown(html_temp, unsafe_allow_html=True)

    st.info("Enter the details of the patient below to predict the presence of appendicitis")
    st.header("Demographic Details of the patient")

    Age = st.number_input('Age', min_value=1, max_value=18, value=10, step=1)
    BMI = st.number_input('BMI', min_value=1.0, max_value=40.0, value=10.0, step=0.1)
    Sex = st.selectbox('Sex',['male','female'])
    Height = st.number_input('Height', min_value=50.00, max_value=190.00, value=100.00, step=0.01)
    Weight = st.number_input('Weight', min_value=4.00, max_value=103.00, value=50.00, step=0.01)

    st.header("Scoring values of the patient")

    Alvarado_Score = st.number_input('Alvarado_Score', min_value=1, max_value=10, value=2, step=1)
    Paedriatic_Appendicitis_Score = st.number_input('Paedriatic_Appendicitis_Score', min_value=1, max_value=10, value=2, step=1)

    st.header("Clinical details of the patient")

    Migratory_Pain = st.selectbox('Migratory Pain', ["yes", "no"])
    Lower_Right_Abd_Pain = st.selectbox('Lower_Right_Abd_Pain', ["yes", "no"])
    Contralateral_Rebound_Tenderness = st.selectbox('Contralateral_Rebound_Tenderness', ["yes", "no"])
    Coughing_Pain = st.selectbox('Coughing_Pain', ["yes", "no"])
    Nausea = st.selectbox('Nausea', ["yes", "no"])
    Loss_of_Appetite = st.selectbox('Loss_of_Appetite', ["yes", "no"])
    Body_Temperature = st.number_input('Body_Temperature', min_value=20.0, max_value=40.0, value=30.0, step=0.1)
    Dysuria = st.selectbox('Dysuria', ["yes", "no"])
    Stool = st.selectbox('Stool', ["normal", "constipation","diarrhea","constipation, diarrhea"])
    Peritonitis = st.selectbox('Peritonitis',["no","local","generalized"])
    Psoas_Sign = st.selectbox('Psoas_Sign', ["yes", "no"])
    Ipsilateral_Rebound_Tenderness = st.selectbox('Ipsilateral_Rebound_Tenderness', ["yes", "no"])
    
    st.header("Laboratory test details of the patient")

    WBC_Count = st.number_input('WBC_Count', min_value=2.00, max_value=38.00, value=10.00, step=0.01)
    Neutrophil_Percentage = st.number_input('Neutrophil_Percentage', min_value=0.00, max_value=100.00, value=10.00, step=0.01)
    Neutrophilia = st.selectbox('Neutrophilia', ["yes", "no"])
    RBC_Count = st.number_input('RBC_Count', min_value=2.00, max_value=15.00, value=10.00, step=0.01)
    Hemoglobin = st.number_input('Hemoglobin', min_value=0.00, max_value=40.0, value=10.0, step=0.1)
    RDW = st.number_input('RDW', min_value=0.0, max_value=100.0, value=10.0, step=0.1)
    Thrombocyte_Count = st.number_input('Thrombocyte_Count', min_value=50, max_value=1000, value=100, step=1)
    Ketones_in_Urine = st.selectbox('Ketones_in_Urine',["no","+","++","+++"])
    RBC_in_Urine = st.selectbox('RBC_in_Urine',["no","+","++","+++"])
    WBC_in_Urine = st.selectbox('WBC_in_Urine',["no","+","++","+++"])
    CRP = st.number_input('CRP', min_value=0.0, max_value=400.0, value=10.0, step=0.1)

    st.header("Ultrasound details of the patient")

    Appendix_on_US = st.selectbox('Appendix_on_US', ["yes", "no"])
    Appendix_Diameter = st.number_input('Appendix_Diameter', min_value=1.0, max_value=20.0, value=10.0, step=0.1)
    Free_Fluids = st.selectbox('Free_Fluids', ["yes", "no"])

    if "show_result" not in st.session_state:
        st.session_state.show_result = False

    col1, col2 = st.columns(2)

    # Predict Button
    with col1:
        if st.button("Predict"):
            result, probability = estimate_appendicities(Age, BMI, Sex, Height, Weight, Alvarado_Score, Paedriatic_Appendicitis_Score, Appendix_on_US,
                           Appendix_Diameter, Migratory_Pain, Lower_Right_Abd_Pain, Contralateral_Rebound_Tenderness,
                           Coughing_Pain, Nausea, Loss_of_Appetite, Body_Temperature, WBC_Count, Neutrophil_Percentage,
                           Neutrophilia, RBC_Count, Hemoglobin, RDW, Thrombocyte_Count, Ketones_in_Urine, RBC_in_Urine,
                           WBC_in_Urine, CRP, Dysuria, Stool, Peritonitis, Psoas_Sign, Ipsilateral_Rebound_Tenderness,
                           Free_Fluids)
            st.session_state.show_result = True
            st.session_state.result = result
            st.session_state.probability = probability

    # Display the result only if button was clicked
    if st.session_state.show_result:
        # Customize only the word 'Appendicitis' or 'No appendicitis'
        result_text = st.session_state.result
        if result_text == 'Appendicitis':
            result_html = f'**Estimated Status: <span style="color:red;">{result_text}</span>**'
        else:
            result_html = f'**Estimated Status: <span style="color:white;">{result_text}</span>**'

        # Display custom HTML for result
        st.markdown(result_html, unsafe_allow_html=True)
        st.success(f"**The probability of having appendicitis is {st.session_state.probability:.2%}**")

    # Clear All Button
    with col2:
        if st.button("Clear All"):
            for key in st.session_state.keys():
                del st.session_state[key]
            st.rerun()

if __name__ == '__main__':
    main()