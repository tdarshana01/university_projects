import streamlit as st
import numpy as np
import pandas as pd
import pickle
import joblib
import os
import json
import cloudpickle

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
    pipeline_path = os.path.join(base_path,'artifacts','pipeline1.pickle')

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

    with open(pipeline_path,'rb') as f:
        pipeline = cloudpickle.load(f)


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
    load_artifacts()
    html_temp = """
        <div style="background: linear-gradient(to right, #11998e, #38ef7d); padding: 15px 10px; border-radius: 12px; box-shadow: 0px 4px 10px rgba(0,0,0,0.2);">
            <h2 style="color: white; text-align: center; font-family: 'Segoe UI', sans-serif; margin: 0;">Pediatric Appendicitis Prediction App</h2>
            <p style="color: #f0fdf4; text-align: center; font-size: 14px; margin-top: 5px;">Predict which patients are most likely to have appendicitis and take action early.</p>
        </div>
        <br>
    """

    st.markdown(html_temp, unsafe_allow_html=True)
    # Sidebar: App Information and Instructions
    st.sidebar.title("📚 About this App")
    st.sidebar.info("""
    This app predicts the likelihood of pediatric appendicitis using machine learning.

    ### 🔍 How to Use:
    - Fill out the patient form **OR**
    - Upload a CSV file with patient data.
    - Click **Predict** to get the result.

    ### ⚠️ Disclaimer:
    This tool is for educational or research use only and not intended for clinical diagnosis.
    """)

    # Optional: Sidebar Links
    st.sidebar.markdown("---")
    st.sidebar.markdown("👥 Made by **Group D** - ST 4035")

    st.info("Enter the details of the patient below to predict the presence of appendicitis")
    # 🧑‍⚕️ Demographic Details
    st.header("🧑‍⚕️ Demographic Details")
    with st.expander("Enter Demographic Information"):
        col1, col2 = st.columns(2)
        with col1:
            Age = st.number_input('📅 Age', min_value=1, max_value=18, value=10, step=1)
            BMI = st.number_input('📏 BMI', min_value=1.0, max_value=40.0, value=10.0, step=0.1)
            Sex = st.selectbox('⚧️ Sex', ['male', 'female'])
        with col2:
            Height = st.number_input('📐 Height (cm)', min_value=50.00, max_value=190.00, value=100.00, step=0.01)
            Weight = st.number_input('⚖️ Weight (kg)', min_value=4.00, max_value=103.00, value=50.00, step=0.01)

    # 📈 Scoring System
    st.header("📈 Appendicitis Scoring")
    with st.expander("Enter Score Details"):
        col1, col2 = st.columns(2)
        with col1:
            Alvarado_Score = st.number_input('🧮 Alvarado Score', min_value=1, max_value=10, value=2, step=1)
        with col2:
            Paedriatic_Appendicitis_Score = st.number_input('🧮 Pediatric Appendicitis Score', min_value=1, max_value=10,
                                                            value=2, step=1)

    # ⚕️ Clinical Symptoms
    st.header("⚕️ Clinical Symptoms")
    with st.expander("Enter Clinical Symptoms"):
        col1, col2 = st.columns(2)
        with col1:
            Migratory_Pain = st.selectbox('➡️ Migratory Pain', ["yes", "no"],
                                          help="Abdominal pain; usually starts in epigastrium and moves to the right lower quadrant")
            Contralateral_Rebound_Tenderness = st.selectbox('🔁 Contralateral Rebound Tenderness', ["yes", "no"],
                                                            help="A state in which pain of the contralateral side (usually, the right lower quadrant) is felt on the release of pressure (usually, in the left lower quadrant) over the abdomen")
            Nausea = st.selectbox('🤢 Nausea', ["yes", "no"],
                                  help="Feeling of sickness/ejection of contents from stomach through the mouth")
            Dysuria = st.selectbox('🔥 Dysuria', ["yes", "no"],
                                   help="Pain or other difficulty during urination")
            Peritonitis = st.selectbox('🧊 Peritonitis', ["no", "local", "generalized"],
                                       help="Spasm of abdominal wall muscles detected on palpation, usually a result of inflammation")
        with col2:
            Lower_Right_Abd_Pain = st.selectbox('🩹 Lower Right Abdominal Pain', ["yes", "no"])
            Coughing_Pain = st.selectbox('💨 Coughing Pain', ["yes", "no"])
            Loss_of_Appetite = st.selectbox('🍽️ Loss of Appetite', ["yes", "no"])
            Stool = st.selectbox('🚽 Stool Type', ["normal", "constipation", "diarrhea", "constipation, diarrhea"])
            Psoas_Sign = st.selectbox('🦵 Psoas Sign', ["yes", "no"],
                                      help="Abdominal pain produced by extension of the hip")
        Ipsilateral_Rebound_Tenderness = st.selectbox('↪️ Ipsilateral Rebound Tenderness', ["yes", "no"],
                                                      help="A state in which pain of the ipsilateral side is felt on the release of pressure over the abdomen")

    # 🧪 Laboratory Results
    st.header("🧪 Laboratory Test Results")
    with st.expander("Enter Lab Results"):
        col1, col2 = st.columns(2)
        with col1:
            WBC_Count = st.number_input('🧬 WBC Count (10^3/µl)', min_value=2.00, max_value=38.00, value=10.00, step=0.01,
                                        help="The number of leucocytes in a unit volume of blood; inflammation parameter")
            Neutrophil_Percentage = st.number_input('🔬 Neutrophil %', min_value=0.00, max_value=100.00, value=10.00,step=0.01,
                                                    help="Mature WBC in the granulocytic series")
            Neutrophilia = st.selectbox('🧪 Neutrophilia', ["yes", "no"],
                                        help="Relative neutrophilic leucocytosis, often a result of a bacterial infection")
            Hemoglobin = st.number_input('🩸 Hemoglobin (g/dl)', min_value=0.00, max_value=40.0, value=10.0, step=0.1,
                                         help="Hemoglobin level; a red protein in the red blood cells that contains iron and is responsible for transporting oxygen")
            RDW = st.number_input('📊 RDW', min_value=0.0, max_value=100.0, value=10.0, step=0.1,
                                  help="Red cell distribution width (RDW), %")
            RBC_Count = st.number_input('🔴 RBC Count', min_value=2.00, max_value=15.00, value=10.00, step=0.01,
                                        help="Red blood cell count (RBC), /pl")
        with col2:
            Thrombocyte_Count = st.number_input('🧫 Thrombocyte Count (per nl)', min_value=50, max_value=1000, value=100, step=1,
                                                help="The number of platelets in a unit volume of bood")
            Ketones_in_Urine = st.selectbox('🧪 Ketones in Urine', ["no", "+", "++", "+++"],
                                            help="Presence of ketone bodies in urine, e.g. in case of anorexia")
            RBC_in_Urine = st.selectbox('🔴 RBC in Urine', ["no", "+", "++", "+++"],
                                        help="Blood in urine")
            WBC_in_Urine = st.selectbox('⚪ WBC in Urine', ["no", "+", "++", "+++"],
                                        help="Leucocytes in urine, e.g., in case of infection")
            CRP = st.number_input('🔥 CRP (C-Reactive Protein, mg/l)', min_value=0.0, max_value=400.0, value=10.0, step=0.1,
                                  help="Protein produced by the liver, elevated in case of inflammation, infection, or injury")
            Body_Temperature = st.number_input('🌡️ Body Temperature (°C)', min_value=20.0, max_value=40.0, value=30.0,
                                               step=0.1)

    # 🩻 Ultrasound
    st.header("🩻 Ultrasound Findings")
    with st.expander("Enter Ultrasound Data"):
        col1, col2 = st.columns(2)
        with col1:
            Appendix_on_US = st.selectbox('📸 Appendix visible on US?', ["yes", "no"])
            Free_Fluids = st.selectbox('💧 Free Fluids Present?', ["yes", "no"])
        with col2:
            Appendix_Diameter = st.number_input('📏 Appendix Diameter (mm)', min_value=1.0, max_value=20.0, value=10.0,
                                                step=0.1)

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

    st.markdown("---")
    st.subheader("Get predictions by uploading a dataset")
    st.info("Upload a dataset and get your predictions!")

    uploaded_file = st.file_uploader("Upload your CSV file", type=['csv'])
    if uploaded_file is not None:
        input_df = pd.read_csv(uploaded_file)
        input_df_1 = input_df.drop('patientID', axis=1)

        expected_columns = ['Age', 'BMI', 'Sex', 'Height', 'Weight', 'Alvarado_Score',
           'Paedriatic_Appendicitis_Score', 'Appendix_on_US', 'Appendix_Diameter',
           'Migratory_Pain', 'Lower_Right_Abd_Pain',
           'Contralateral_Rebound_Tenderness', 'Coughing_Pain', 'Nausea',
           'Loss_of_Appetite', 'Body_Temperature', 'WBC_Count',
           'Neutrophil_Percentage', 'Neutrophilia', 'RBC_Count', 'Hemoglobin',
           'RDW', 'Thrombocyte_Count', 'Ketones_in_Urine', 'RBC_in_Urine',
           'WBC_in_Urine', 'CRP', 'Dysuria', 'Stool', 'Peritonitis', 'Psoas_Sign',
           'Ipsilateral_Rebound_Tenderness', 'Free_Fluids']

        input_df_1 = input_df_1[expected_columns]

        base_path = os.path.dirname(__file__)
        pipeline_path = os.path.join(base_path, 'artifacts', 'pipeline.pickle')
        pipeline = joblib.load(pipeline_path)
        transformed_data = pipeline.transform(input_df_1)
        prediction = model.predict(transformed_data)
        pred_proba = model.predict_proba(transformed_data)[:,1]
        prediction = pd.Series(prediction)
        prediction = prediction.apply(lambda x: 'Appendicitis' if x == 1 else 'No Appendicitis')
        pred_proba = pd.Series(pred_proba)

        result = pd.DataFrame({
            'patientID': input_df['patientID'],
            'Diagnosis': prediction,
            'Diagnosis probability': (pred_proba * 100).apply(lambda x: f'{x:.2f}%')
        })

        st.dataframe(result)

        no_churn = len(result[result['Diagnosis'] == 'Appendicitis'])
        total = len(result)
        percentage = np.round((no_churn / total * 100), 2)

        st.info(f"{percentage}% of patients likely to have appendicitis")

    else:
        st.warning("Please upload a dataset and get your predictions!")

if __name__ == '__main__':
    main()

