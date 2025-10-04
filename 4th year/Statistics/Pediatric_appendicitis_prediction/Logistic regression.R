library(caret)

train_set$Diagnosis <- factor(train_set$Diagnosis)

null_model <- glm(Diagnosis ~ 1,data = train_set,family = binomial)
full_model <- glm(Diagnosis ~.,data = train_set,family = binomial)

forward_model <- step(null_model,
                      scope = formula(full_model),
                      direction = 'forward')

summary(forward_model)

y_prob <-  predict.glm(forward_model,newdata = test_set,type = 'response')
y_pred <- ifelse(y_prob>0.5,1,0)

confusionMatrix(factor(test_set$Diagnosis),factor(y_pred),positive = '1')

library(car)
vif(forward_model)
