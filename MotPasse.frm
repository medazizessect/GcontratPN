VERSION 5.00

Begin VB.Form MotPasse
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
    ClientWidth  = 5340
    ClientHeight = 2535
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.CommandButton Command2
        Caption = "I???"
        Left   = 240
        Top    = 960
        Width  = 1215
        Height = 735
        TabIndex = 5
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 8,25
            Charset       = 178
            Weight        = 400
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = MotPasse.frx:0000
        Style = 1
    End
    Begin VB.CommandButton Command1
        Caption = "??C??"
        Left   = 240
        Top    = 120
        Width  = 1215
        Height = 735
        TabIndex = 2
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 8,25
            Charset       = 178
            Weight        = 400
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = MotPasse.frx:08DE
        Style = 1
    End
    Begin VB.TextBox Text1
        Left   = 1800
        Top    = 240
        Width  = 1335
        Height = 465
        TabIndex = 0
        BeginProperty Font
            Name          = "MS Sans Serif"
            Size          = 13,5
            Charset       = 178
            Weight        = 400
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
    End
    Begin VB.TextBox Text2
        Left   = 1800
        Top    = 1080
        Width  = 1335
        Height = 465
        TabIndex = 3
        PasswordChar = "*"
        IMEMode = 3
        BeginProperty Font
            Name          = "MS Sans Serif"
            Size          = 13,5
            Charset       = 178
            Weight        = 400
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
    End
    Begin VB.Label Label1
        Caption = "??? C???E??? :"
        ForeColor = 8388608
        Left   = 3240
        Top    = 360
        Width  = 1815
        Height = 375
        TabIndex = 1
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 12
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        RightToLeft = -1              'True
    End
    Begin VB.Label Label2
        Caption = "???E C??E?? :"
        ForeColor = 8388608
        Left   = 3480
        Top    = 1200
        Width  = 1575
        Height = 375
        TabIndex = 4
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 12
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        RightToLeft = -1              'True
    End
    Begin VB.Label Label3
        Caption = "?? C??? ?? 3 ??C??CE ??? "
        ForeColor = 8388736
        Left   = 1440
        Top    = 2040
        Width  = 2055
        Height = 255
        TabIndex = 6
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 8,25
            Charset       = 178
            Weight        = 400
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        RightToLeft = -1              'True
    End
End
