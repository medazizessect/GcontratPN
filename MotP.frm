VERSION 5.00

Begin VB.Form MotP
    Caption = "???E C??E??"
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form31"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 4530
    ClientHeight = 1320
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.CommandButton Command2
        Left   = 120
        Top    = 720
        Width  = 1335
        Height = 495
        TabIndex = 3
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 9,75
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = MotP.frx:0000
        Style = 1
    End
    Begin VB.CommandButton Command1
        Left   = 120
        Top    = 120
        Width  = 1335
        Height = 495
        TabIndex = 2
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 9,75
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = MotP.frx:08DE
        Style = 1
    End
    Begin VB.TextBox Text1
        BackColor = -2147483624
        ForeColor = -2147483646
        Left   = 1680
        Top    = 480
        Width  = 1335
        Height = 350
        TabIndex = 0
        PasswordChar = "*"
        IMEMode = 3
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 12
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
    End
    Begin VB.Label Label2
        Caption = "???E C??E?? :"
        Left   = 3240
        Top    = 600
        Width  = 1335
        Height = 375
        TabIndex = 1
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 9,75
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        RightToLeft = -1              'True
    End
End
